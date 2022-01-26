<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\MemberModel;
use App\Models\PphModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Transaction extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_sale_detail = new SaleDetailModel();
		$this->m_sale = new SaleModel();
		$this->m_item = new ItemModel();
		$this->m_member = new MemberModel();
		$this->m_user = new UserModel();
		$this->m_pph = new PphModel();
	}
	public function index()
	{

		if (!get_cookie('transaction')) {
			$find_detail = array();
			$find_sale = null;
			$count_member = null;
		} else {
			$find_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction'));
			$find_sale = $this->m_sale->getAllSale(get_cookie('transaction'));
			if (!empty($find_sale)) {
				$count_member = $this->m_sale->where('member_id', $find_sale[0]->user_id)->countAll();
			} else {
				$count_member = null;
			}
		}
		// set_cookie('_transaction', 1, time() + 900);
		$pph_model = $this->m_pph->getAllPPh();
		// Send Data
		$data = [
			'transaction' => $find_detail,
			'pph' => $pph_model,
			'member' => $this->m_member->getMemberWhere(0),
			'validation' => $this->validate,
			'item' => $this->m_item->getAllItemWhere(),
			'find_sale' => $find_sale,
			'count_user' => $count_member,
		];
		if (!empty($this->request->getPost('submit_member'))) {
			$formSubmit = $this->validate([
				'member_id' => 'required',
			]);
			if (!$formSubmit) {
				return redirect()->to('/transaction')->withInput();
			} else {
				$string = "0123456789BCDFGHJKLMNPQRSTVWXYZ";
				$token = substr(str_shuffle($string), 0, 10);
				$find_member = $this->m_member->find($this->request->getPost('member_id'));
				$save = $this->m_sale->save([
					'sale_code' => $token,
					'sale_total' => 0,
					'sale_pay' => 0,
					'sale_discount' => $find_member->member_discount,
					'sale_profit' => 0,
					'sale_status' => 0,
					'sale_ket' => 'Project',
					'user_id' => user()->id,
					'member_id' => $this->request->getPost('member_id'),
				]);
				if ($save) {
					set_cookie('transaction', $this->m_sale->getInsertID(), 900);
					setcookie('transaction', $this->m_sale->getInsertID(), 900);
					return redirect()->to('/transaction')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Gagal Membuat Transaksi Baru');
					return redirect()->to('/transaction')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('submit_transaksi'))) {
			$formSubmit = $this->validate([
				'item_barang' => 'required',
				'item_quantity' => 'required|integer',
			]);
			if (!$formSubmit) {
				return redirect()->to('/transaction')->withInput();
			} else {
				if (get_cookie('transaction')) {
					// Cek apakah sudah ada item tersebut di database
					$check = $this->m_sale_detail->where('item_id', $this->request->getPost('item_barang'))->where('sale_id', get_cookie('transaction'))->findAll();
					if (!empty($check)) {
						session()->setFlashdata('gagal', 'Barang Sudah Ada Di List, Gagal Menambahkan');
						return redirect()->to('/transaction')->withCookies();
					} else {
						$item_barang = $this->m_item->find($this->request->getPost('item_barang'));
						$stock_sisa = $item_barang->item_stock - $this->request->getPost('item_quantity');
						if ($stock_sisa < 0) {
							session()->setFlashdata('gagal', 'Stok Barang Yang Tersedia Tidak Mencukupi');
							return redirect()->to('/transaction')->withCookies();
						} else {
							// Perhitungan Total Belanjar
							$detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;
							$discount = $detail * $find_sale[0]->sale_discount / 100;
							// $detail_total = $detail - $discount;
							$pph = $detail * $pph_model[0]->pph_value / 100;
							$detail_total = $detail - $discount + $pph;
							$total_sale = $find_sale[0]->sale_total + $detail_total;

							// Total Keuntungan
							$profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;
							$total_profit = $find_sale[0]->sale_profit + $profit_per_item - $discount;
							// $total_discount = $find_sale[0]->sale_discount + $item_barang->item_discount;
							$save_sale_detail = $this->m_sale_detail->save([
								'detail_total' => $detail,
								'detail_quantity' => $this->request->getPost('item_quantity'),
								'user_id' => user()->id,
								'item_id' => $this->request->getPost('item_barang'),
								'sale_id' => get_cookie('transaction'),
							]);
							if ($save_sale_detail) {
								$save_item = $this->m_item->save([
									'id' => $item_barang->id,
									'item_stock' => $stock_sisa,
								]);
								if ($save_item) {
									$save_sale = $this->m_sale->save([
										'id' => get_cookie('transaction'),
										'sale_total' => $total_sale,
										// 'sale_discount' => $total_discount,
										'sale_profit' => $total_profit,
									]);
									if ($save_sale) {
										return redirect()->to('/transaction')->withCookies();
									} else {
										session()->setFlashdata('gagal', 'Gagal Menambahkan Transaksi');
										return redirect()->to('/transaction')->withCookies();
									}
								} else {
									session()->setFlashdata('gagal', 'Gagal Mengurangkan Stok Item');
									return redirect()->to('/transaction')->withCookies();
								}
							} else {
								session()->setFlashdata('gagal', 'Gagal Menambahkan Detail Transaksi');
								return redirect()->to('/transaction')->withCookies();
							}
						}
					}
				} else {
					session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');
					return redirect()->to('/transaction')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('batalkan_transaksi'))) {
			if (get_cookie('transaction')) {
				$find_sale_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction'));
				$find_item = $this->m_item->findAll();
				if (!empty($find_sale_detail))
					foreach ($find_sale_detail as $d) {
						foreach ($find_item as $i) {
							if ($d->item_id == $i->id) {
								$this->m_item->save([
									'id' => $i->id,
									'item_stock' => $i->item_stock + $d->detail_quantity,
								]);
							}
						}
						$status = true;
					}
				else {
					$status = true;
				}
				if ($status) {
					if ($this->m_sale->delete(get_cookie('transaction'))) {
						session()->setFlashdata('berhasil', 'Transaksi Berhasil Dibatalkan');
						return redirect()->to('/transaction')->withCookies();
					} else {
						session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi');
						return redirect()->to('/transaction')->withCookies();
					}
				} else {
					session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok');
					return redirect()->to('/transaction')->withCookies();
				}
			} else {
				session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');
				return redirect()->to('/transaction')->withCookies();
			}
		} else if (!empty($this->request->getPost('delete_item'))) {
			if (get_cookie('transaction')) {


				// Ambil detail penjualan
				$detail_sale = $this->m_sale_detail->find($this->request->getPost('id_item'));
				// Ambil barang berdasarkan id item yang ada didetail penjualan
				$item_barang = $this->m_item->find($detail_sale->item_id);
				// Hitung stocknya jika dihapus
				$stock_sisa = $item_barang->item_stock + $detail_sale->detail_quantity;

				// Perhitungan Total Belanjar
				$detail = $detail_sale->detail_quantity * $item_barang->item_sale;
				$discount = $detail * $find_sale[0]->sale_discount / 100;
				// $detail_total = $detail - $discount;
				$pph = $detail * $pph_model[0]->pph_value / 100;
				$detail_total = $detail - $discount + $pph;
				$total_sale = $find_sale[0]->sale_total - $detail_total;

				// Total Keuntungan
				$profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;
				$total_profit = $find_sale[0]->sale_profit - $profit_per_item + $discount;
				// Perlu input itu ada stoknya, sale_total,sale_profit
				// Pertama ubah stocknya
				$save_update_stock = $this->m_item->save([
					'id' => $detail_sale->item_id,
					'item_stock' => $stock_sisa,
				]);
				if ($save_update_stock) {
					$save_update_sale = $this->m_sale->save([
						'id' => $detail_sale->sale_id,
						'sale_total' => $total_sale,
						'sale_profit' => $total_profit,
					]);
					if ($save_update_sale) {
						if ($this->m_sale_detail->delete($this->request->getPost('id_item'))) {
							return redirect()->to('/transaction')->withCookies();
						} else {
							session()->setFlashdata('gagal', 'Gagal Menghapus Barang');
							return redirect()->to('/transaction')->withCookies();
						}
					} else {
						session()->setFlashdata('gagal', 'Gagal Memperbaharui Transaksi');
						return redirect()->to('/transaction')->withCookies();
					}
				} else {
					session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');
					return redirect()->to('/transaction')->withCookies();
				}
			} else {
				session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');
				return redirect()->to('/transaction')->withCookies();
			}
		} else if (!empty($this->request->getPost('invoice'))) {
			if (get_cookie('transaction')) {
				$save_update_status = $this->m_sale->save([
					'id' => get_cookie('transaction'),
					'sale_status' => 1,
				]);
				if ($save_update_status) {
					$find_member = $this->m_member->find($find_sale[0]->member_id);
					$find_user = $this->m_user->getUserRole($find_sale[0]->user_id);
					$data = [
						'detail' => $find_detail,
						'sale' => $find_sale,
						'pph' => $pph_model,
						'member' => $find_member,
						'user' => $find_user,
					];
					// return view('Admin/page/invoice_transaction', $data);
					set_cookie('transaction', false, -900);
					delete_cookie("transaction");
					$mpdf = new \Mpdf\Mpdf();
					$html = view('Admin/page/invoice_transaction', $data);
					$mpdf->WriteHTML($html);
					// $mpdf->SetWatermarkText("SUKSES");
					// $mpdf->showWatermarkText = true;
					$mpdf->showImageErrors = true;
					$this->response->setHeader('Content-Type', 'application/pdf');
					// $mpdf->AutoPrint(true);
					$mpdf->SetJS('this.print();');
					// $mpdf->Output('Invoice Transaction.pdf', 'I'); 
					$mpdf->Output();
				}
			} else {
				session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');
				return redirect()->to('/transaction')->withCookies();
			}
		} else {
			return view('Admin/page/transaction', $data);
		}
	}

	public function validation_payment()
	{
		if (get_cookie('transaction') || !empty($this->request->getPost('cetak_ulang'))) {
			if (!empty($this->request->getPost('cetak_ulang'))) {
				$id_transaksi = $this->request->getPost('id_transaksi');
			} else {
				$id_transaksi = get_cookie('transaction');
			}
			$save = $this->m_sale->save([
				'id' => $id_transaksi,
				'sale_pay' => $this->request->getPost('bayar'),
			]);
			if ($save) {
				echo json_encode(array("status" => TRUE));
			} else {
				echo json_encode(array("status" => FALSE));
			}
		}
	}

	public function add_handling_report()
	{
		if (get_cookie('transaction') || !empty($this->request->getPost('handling'))) {
			if (!empty($this->request->getPost('handling'))) {
				$id_transaksi = $this->request->getPost('id_transaksi');
			} else {
				$id_transaksi = get_cookie('transaction');
			}
			$find = $this->m_sale->where('id', $id_transaksi)->find();

			$save = $this->m_sale->save([
				'id' => $id_transaksi,
				'sale_handling' => $this->request->getPost('handling_tot'),
				'sale_total' => $this->request->getPost('handling_tot') + $find[0]->sale_total,
			]);
			if ($save) {
				// echo json_encode(array("status" => TRUE));
				return redirect()->to('/transaction/report/search?sale_code=' . $find[0]->sale_code)->withCookies();
			} else {
				// echo json_encode(array("status" => FALSE));
				return redirect()->to('/transaction/report/search?sale_code=' . $find[0]->sale_code)->withCookies();
			}
		}
	}

	public function add_handling()
	{
		if (get_cookie('transaction') || !empty($this->request->getPost('handling'))) {
			if (!empty($this->request->getPost('handling'))) {
				$id_transaksi = $this->request->getPost('id_transaksi');
			} else {
				$id_transaksi = get_cookie('transaction');
			}
			$find = $this->m_sale->where('id', $id_transaksi)->find();

			$save = $this->m_sale->save([
				'id' => $id_transaksi,
				'sale_handling' => $this->request->getPost('handling_tot'),
				'sale_total' => $this->request->getPost('handling_tot') + $find[0]->sale_total,
			]);
			if ($save) {
				// echo json_encode(array("status" => TRUE));
				return redirect()->to('/transaction')->withCookies();
			} else {
				// echo json_encode(array("status" => FALSE));
				return redirect()->to('/transaction')->withCookies();
			}
		}
	}

	public function report()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('Project'),
		];
		$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->findAll();
		if (!empty($this->request->getPost('invoice'))) {
			$save_update_status = $this->m_sale->save([
				'id' => $find_sale_code[0]->id,
				'sale_status' => 1,
			]);
			if ($save_update_status) {
				$find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code[0]->id);
				$find_sale = $this->m_sale->getAllSale($find_sale_code[0]->id);
				$find_member = $this->m_member->find($find_sale[0]->member_id);
				$find_user = $this->m_user->getUserRole($find_sale[0]->user_id);
				$pph_model = $this->m_pph->getAllPPh();
				$data = [
					'detail' => $find_detail,
					'sale' => $find_sale,
					'pph' => $pph_model,
					'member' => $find_member,
					'user' => $find_user,
				];
				// return view('Admin/page/invoice_transaction', $data);
				set_cookie('transaction', false, 900);
				$mpdf = new \Mpdf\Mpdf();
				$html = view('Admin/page/invoice_transaction', $data);
				$mpdf->WriteHTML($html);
				// $mpdf->SetWatermarkText("SUKSES");
				// $mpdf->showWatermarkText = true;
				$mpdf->showImageErrors = true;
				$this->response->setHeader('Content-Type', 'application/pdf');
				// $mpdf->AutoPrint(true);
				$mpdf->SetJS('this.print();');
				// $mpdf->Output('Invoice Transaction.pdf', 'I'); 
				$mpdf->Output();
			}
		}
		if (!empty($this->request->getPost('delete_transaksi'))) {
			$find_sale_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code[0]->id);
			$find_item = $this->m_item->findAll();
			if (!empty($find_sale_detail))
				foreach ($find_sale_detail as $d) {
					foreach ($find_item as $i) {
						if ($d->item_id == $i->id) {
							$this->m_item->save([
								'id' => $i->id,
								'item_stock' => $i->item_stock + $d->detail_quantity,
							]);
						}
					}
					$status = true;
				}
			else {
				$status = true;
			}
			if ($status) {
				if ($this->m_sale->delete($find_sale_code[0]->id)) {
					session()->setFlashdata('berhasil', 'Berhasil Menghapus Transaksi Yang Dipilih');
					return redirect()->to('/transaction/report')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Gagal Menghapus Transaksi Yang Dipilih');
					return redirect()->to('/transaction/report')->withCookies();
				}
			} else {
				session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Transaksi Yang Dipilih');
				return redirect()->to('/transaction/report')->withCookies();
			}
		} else {
			return view('Admin/page/report', $data);
		}
	}

	public function search()
	{
		if ($this->request->getGet('sale_code') != null) {
			$sale_code = $this->request->getGet('sale_code');
			$find_sale_code = $this->m_sale->where('sale_code', $sale_code)->findAll();
			if (!empty($find_sale_code)) {
				$count_member = $this->m_sale->where('member_id', $find_sale_code[0]->user_id)->countAllResults();
				$find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code[0]->id);
				$find_sale = $this->m_sale->getAllSale($find_sale_code[0]->id);
				$pph_model = $this->m_pph->getAllPPh();
				$data = [
					'transaction' => $find_detail,
					'member' => $this->m_member->findAll(),
					'validation' => $this->validate,
					'item' => $this->m_item->getAllItemWhere(),
					'find_sale' => $find_sale,
					'pph' => $pph_model,
					'count_user' => $count_member,
				];
				if (!empty($this->request->getPost('submit_transaksi'))) {
					$formSubmit = $this->validate([
						'item_barang' => 'required',
						'item_quantity' => 'required|integer',
					]);
					if (!$formSubmit) {
						return redirect()->to('/transaction')->withInput();
					} else {
						// Cek apakah sudah ada item tersebut di database
						$check = $this->m_sale_detail->where('item_id', $this->request->getPost('item_barang'))->where('sale_id', $find_sale_code[0]->id)->findAll();
						if (!empty($check)) {
							session()->setFlashdata('gagal', 'Barang Yang  Dipilih Sudah Ada Dalam List Transaksi');
							return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
						} else {
							$item_barang = $this->m_item->find($this->request->getPost('item_barang'));
							$stock_sisa = $item_barang->item_stock - $this->request->getPost('item_quantity');
							if ($stock_sisa < 0) {
								session()->setFlashdata('gagal', 'Stok Barang Tidak Mencukupi');
								return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
							} else {
								// Perhitungan Total Belanjar
								$detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;
								$discount = $detail * $find_sale[0]->sale_discount / 100;
								// $detail_total = $detail - $discount;
								$pph = $detail * $pph_model[0]->pph_value / 100;
								$detail_total = $detail - $discount + $pph;
								$total_sale = $find_sale[0]->sale_total + $detail_total;

								// Total Keuntungan
								$profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;
								$total_profit = $find_sale[0]->sale_profit + $profit_per_item - $discount;
								// $total_discount = $find_sale[0]->sale_discount + $item_barang->item_discount;
								$save_sale_detail = $this->m_sale_detail->save([
									'detail_total' => $detail,
									'detail_quantity' => $this->request->getPost('item_quantity'),
									'user_id' => user()->id,
									'item_id' => $this->request->getPost('item_barang'),
									'sale_id' => $find_sale_code[0]->id,
								]);
								if ($save_sale_detail) {
									$save_item = $this->m_item->save([
										'id' => $item_barang->id,
										'item_stock' => $stock_sisa,
									]);
									if ($save_item) {
										$save_sale = $this->m_sale->save([
											'id' => $find_sale_code[0]->id,
											'sale_total' => $total_sale,
											// 'sale_discount' => $total_discount,
											'sale_profit' => $total_profit,
										]);
										if ($save_sale) {
											return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
										} else {
											session()->setFlashdata('gagal', 'Gagal Mengubah Transaksi Yang Dipilih');
											return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
										}
									} else {
										session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');
										return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
									}
								} else {
									session()->setFlashdata('gagal', 'Gagal Menambahkan Detail Transaksi');
									return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
								}
							}
						}
					}
				} else if (!empty($this->request->getPost('batalkan_transaksi'))) {
					$find_sale_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code[0]->id);
					$find_item = $this->m_item->findAll();
					if (!empty($find_sale_detail))
						foreach ($find_sale_detail as $d) {
							foreach ($find_item as $i) {
								if ($d->item_id == $i->id) {
									$this->m_item->save([
										'id' => $i->id,
										'item_stock' => $i->item_stock + $d->detail_quantity,
									]);
								}
							}
							$status = true;
						}
					else {
						$status = true;
					}
					if ($status) {
						if ($this->m_sale->delete($find_sale_code[0]->id)) {
							session()->setFlashdata('berhasil', 'Berhasil Membatalkan Transaksi Yang Dipilih');
							return redirect()->to('/transaction/report')->withCookies();
						} else {
							session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi Yang Dipilih');
							return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
						}
					} else {
						session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');
						return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
					}
				} else if (!empty($this->request->getPost('delete_item'))) {

					// Ambil detail penjualan
					$detail_sale = $this->m_sale_detail->find($this->request->getPost('id_item'));
					// Ambil barang berdasarkan id item yang ada didetail penjualan
					$item_barang = $this->m_item->find($detail_sale->item_id);
					// Hitung stocknya jika dihapus
					$stock_sisa = $item_barang->item_stock + $detail_sale->detail_quantity;

					// Perhitungan Total Belanjar
					$detail = $detail_sale->detail_quantity * $item_barang->item_sale;
					$discount = $detail * $find_sale[0]->sale_discount / 100;
					// $detail_total = $detail - $discount;
					$pph = $detail * $pph_model[0]->pph_value / 100;
					$detail_total = $detail - $discount + $pph;
					$total_sale = $find_sale[0]->sale_total - $detail_total;

					// Total Keuntungan
					$profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;
					$total_profit = $find_sale[0]->sale_profit - $profit_per_item + $discount;

					// Perlu input itu ada stoknya, sale_total,sale_profit
					// Pertama ubah stocknya
					$save_update_stock = $this->m_item->save([
						'id' => $detail_sale->item_id,
						'item_stock' => $stock_sisa,
					]);
					if ($save_update_stock) {
						$save_update_sale = $this->m_sale->save([
							'id' => $detail_sale->sale_id,
							'sale_total' => $total_sale,
							'sale_profit' => $total_profit,
						]);
						if ($save_update_sale) {
							if ($this->m_sale_detail->delete($this->request->getPost('id_item'))) {
								return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
							} else {
								session()->setFlashdata('gagal', 'Gagal Menghapus Item Barang Yang Dipilih');
								return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
							}
						} else {
							session()->setFlashdata('gagal', 'Gagal Memperbaharui Transaksi Yang Dipilih');
							return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
						}
					} else {
						session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');
						return redirect()->to('/transaction/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
					}
				} else if (!empty($this->request->getPost('invoice'))) {

					$save_update_status = $this->m_sale->save([
						'id' => $find_sale_code[0]->id,
						'sale_status' => 1,
					]);
					if ($save_update_status) {
						$find_member = $this->m_member->find($find_sale[0]->member_id);
						$find_user = $this->m_user->getUserRole($find_sale[0]->user_id);
						$data = [
							'detail' => $find_detail,
							'sale' => $find_sale,
							'pph' => $pph_model,
							'member' => $find_member,
							'user' => $find_user,
						];
						// return view('Admin/page/invoice_transaction', $data);
						set_cookie('transaction', false, 900);
						$mpdf = new \Mpdf\Mpdf();
						$html = view('Admin/page/invoice_transaction', $data);
						$mpdf->WriteHTML($html);
						// $mpdf->SetWatermarkText("SUKSES");
						// $mpdf->showWatermarkText = true;
						$mpdf->showImageErrors = true;
						$this->response->setHeader('Content-Type', 'application/pdf');
						// $mpdf->AutoPrint(true);
						$mpdf->SetJS('this.print();');
						// $mpdf->Output('Invoice Transaction.pdf', 'I'); 
						$mpdf->Output();
					}
				} else {
					return view('Admin/page/search', $data);
				}
			} else {
				return redirect()->to('/transaction/report');
			}
		} else {
			return redirect()->to('/transaction/report');
		}
	}

	public function pph()
	{
		if (in_groups('SUPER ADMIN') || in_groups('KASIR')) {

			$data = [
				'pph' => $this->m_pph->getAllPPh(),
				'validation' => $this->validate,
			];
			if (!empty($this->request->getPost('update_status_order'))) {
				$save = $this->m_pph->save([
					'id' => $this->request->getPost('id_order'),
					'pph_value' => $this->request->getPost('pph'),
				]);
				if ($save) {
					session()->setFlashdata('berhasil', 'PPh Berhasil Diperbaharui');
					return redirect()->to('/transaction/pph')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'PPh Gagal Diperbaharui');
					return redirect()->to('/transaction/pph')->withCookies();
				}
			} else {
				return view('Admin/page/pph', $data);
			}
		} else {
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}
	}
}
