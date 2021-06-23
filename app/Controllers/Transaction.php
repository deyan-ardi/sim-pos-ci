<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\MemberModel;
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
	}
	public function index()
	{

		if (!get_cookie('transaction')) {
			$find_detail = array();
			$find_sale = null;
		} else {
			$find_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction'));
			$find_sale = $this->m_sale->getAllSale(get_cookie('transaction'));
		}
		// set_cookie('_transaction', 1, time() + 900);
		// Send Data
		$data = [
			'transaction' => $find_detail,
			'member' => $this->m_member->findAll(),
			'validation' => $this->validate,
			'item' => $this->m_item->findAll(),
			'find_sale' => $find_sale
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
					'user_id' => user()->id,
					'member_id' => $this->request->getPost('member_id'),
				]);
				set_cookie('transaction', $this->m_sale->getInsertID(), 900);
				if ($save) {
					echo "Berhasil Membuat Transaksi Member";
				} else {
					echo "Gagal Membuat Transaksi Member";
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
						echo "Barang Sudah Ada Di List";
					} else {
						$item_barang = $this->m_item->find($this->request->getPost('item_barang'));
						$stock_sisa = $item_barang->item_stock - $this->request->getPost('item_quantity');
						if ($stock_sisa < 0) {
							echo "Stok Barang Tidak Mencukupi";
						} else {
							// Perhitungan
							$detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;
							$discount = $detail * $find_sale[0]->sale_discount / 100;
							$detail_total = $detail - $discount;
							$profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;

							// Total Belanja
							$total_sale = $find_sale[0]->sale_total + $detail_total;
							// Total Keuntungan
							$total_profit = $find_sale[0]->sale_profit + $profit_per_item;
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
										echo "Berhasil Menambahkan Transaksi";
									} else {
										echo "Gagal Mengubah Transaksi";
									}
								} else {
									echo "Gagal Mengurangkan Stock Barang";
								}
							} else {
								echo "Gagal Menambahkan Detail Transaksi";
							}
						}
					}
				} else {
					echo "Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi";
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
						echo "Berhasil Membatalkan Transaksi";
					} else {
						echo "Gagal Membatalkan Transaksi";
					}
				} else {
					echo "Gagal Mengupdate Stok";
				}
			} else {
				echo "Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi";
			}
		} else if (!empty($this->request->getPost('delete_item'))) {
			if (get_cookie('transaction')) {
				// Ambil detail penjualan
				$detail_sale = $this->m_sale_detail->find($this->request->getPost('id_item'));
				// Ambil barang berdasarkan id item yang ada didetail penjualan
				$item_barang = $this->m_item->find($detail_sale->item_id);
				// Hitung stocknya jika dihapus
				$stock_sisa = $item_barang->item_stock + $detail_sale->detail_quantity;

				// Perhitungan
				$detail = $detail_sale->detail_quantity * $item_barang->item_sale;
				$discount = $detail * $find_sale[0]->sale_discount / 100;
				$detail_total = $detail - $discount;
				$profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;

				// Total Belanja
				$total_sale = $find_sale[0]->sale_total - $detail_total;
				// Total Keuntungan
				$total_profit = $find_sale[0]->sale_profit - $profit_per_item;

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
							echo "Berhasil menghapus barang";
						} else {
							echo "Gagal menghapus barang";
						}
					} else {
						echo "Gagal mengupdate transaksi";
					}
				} else {
					echo "Gagal mengupdate stock";
				}
			} else {
				echo "Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi";
			}
		} else if (!empty($this->request->getPost('invoice'))) {
            if (get_cookie('transaction')) {
				$save_update_status = $this->m_sale->save([
					'id' => get_cookie('transaction'),
					'sale_status' => 1,
				]);
				if($save_update_status){
					$find_member = $this->m_member->find($find_sale[0]->member_id);
					$find_user = $this->m_user->getUserRole($find_sale[0]->user_id);
					$data = [
						'detail' => $find_detail,
						'sale' => $find_sale,
						'member' => $find_member,
						'user' => $find_user,
					];
					// return view('Admin/page/invoice_transaction', $data);
					set_cookie('transaction', false, 900);
					$mpdf = new \Mpdf\Mpdf();
					$html = view('Admin/page/invoice_transaction', $data);
					$mpdf->WriteHTML($html);
					$mpdf->SetWatermarkText("SUKSES");
					$mpdf->showWatermarkText = true;
					$mpdf->showImageErrors = true;
					$this->response->setHeader('Content-Type', 'application/pdf');
					// $mpdf->AutoPrint(true);
					$mpdf->SetJS('this.print();');
					// $mpdf->Output('Invoice Transaction.pdf', 'I'); 
					$mpdf->Output(); 
					
				}
            }else{
				echo "Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi";
			}
		} else {
			return view('Admin/page/transaction', $data);
		}
	}

	public function validation_payment(){
		if (get_cookie('transaction')) {
			$save = $this->m_sale->save([
				'id' => get_cookie('transaction'),
				'sale_pay' => $this->request->getPost('bayar'),
			]);
			if($save){
				echo json_encode(array("status" => TRUE));
			}else{
				echo json_encode(array("status" => FALSE));
			}
		}
	}
}
