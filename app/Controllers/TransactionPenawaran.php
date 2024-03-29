<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceSettingModel;
use App\Models\ItemModel;
use App\Models\MemberModel;
use App\Models\PphModel;
use App\Models\PenawaranDetailModel;
use App\Models\PenawaranModel;
use App\Models\RequestOrderModel;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;
use App\Models\UserModel;

class TransactionPenawaran extends BaseController
{
	protected $validate;
	protected $m_penawaran_detail;
	protected $m_penawaran;
	protected $m_item;
	protected $m_sale;
	protected $m_sale_detail;
	protected $m_member;
	protected $m_user;
	protected $m_pph;
	protected $m_request_order;
	protected $m_invoice;
	public function __construct()
	{
		$this->validate      = \Config\Services::validation();
		$this->m_penawaran_detail = new PenawaranDetailModel();
		$this->m_penawaran      = new PenawaranModel();
		$this->m_item        = new ItemModel();
		$this->m_sale 		= new SaleModel();
		$this->m_sale_detail = new SaleDetailModel();
		$this->m_member      = new MemberModel();
		$this->m_user        = new UserModel();
		$this->m_pph         = new PphModel();
		$this->m_request_order = new RequestOrderModel();
		$this->m_invoice     = new InvoiceSettingModel();
	}

	public function _month($bulan)
	{
		if ($bulan == '01') {
			return 'I';
		}
		if ($bulan == '02') {
			return 'II';
		}
		if ($bulan == '03') {
			return 'III';
		}
		if ($bulan == '04') {
			return 'IV';
		}
		if ($bulan == '05') {
			return 'V';
		}
		if ($bulan == '06') {
			return 'VI';
		}
		if ($bulan == '07') {
			return 'VII';
		}
		if ($bulan == '08') {
			return 'VIII';
		}
		if ($bulan == '09') {
			return 'IX';
		}
		if ($bulan == '10') {
			return 'X';
		}
		if ($bulan == '11') {
			return 'XI';
		}

		return 'XII';
	}

	public function index()
	{
		if (!get_cookie('penawaran')) {
			$find_detail  = [];
			$find_sale    = null;
			$count_member = null;
		} else {
			$find_detail = $this->m_penawaran_detail->getAllPenawaranDetail(get_cookie('penawaran'));
			$find_sale   = $this->m_penawaran->getAllPenawaran(get_cookie('penawaran'));
			if (!empty($find_sale)) {
				$count_member = $this->m_penawaran->where('member_id', $find_sale[0]->user_id)->countAll();
			} else {
				$count_member = null;
			}
		}
		// set_cookie('_transaction', 1, time() + 900);
		$pph_model = $this->m_pph->getAllPPh();
		// Send Data
		$bulan        = $this->_month(date('m'));
		$tahun        = date('Y');
		$last_id      = $this->m_penawaran->orderBy('id', 'DESC')->first() == null ? 1 : $this->m_penawaran->orderBy('id', 'DESC')->first()->id + 1;
		$leading_kode = sprintf('%03d', $last_id);
		$kode_transaksi = "{$leading_kode}/PENAWARAN/DIN/{$bulan}/{$tahun}";
		$data = [
			'transaction' => $find_detail,
			'pph'         => $pph_model,
			'member'      => $this->m_member->getMemberWhere(0),
			'validation'  => $this->validate,
			'item'        => $this->m_item->getAllItemWhere(),
			'find_sale'   => $find_sale,
			'count_user'  => $count_member,
		];
		if (!empty($this->request->getPost('submit_member'))) {
			$formSubmit = $this->validate([
				'member_id' => 'required',
			]);
			if (!$formSubmit) {
				return redirect()->to('/transaction/marketing/kasir-penawaran')->withInput();
			}
			$find_member = $this->m_member->find($this->request->getPost('member_id'));
			$save        = $this->m_penawaran->save([
				'penawaran_code'     => $kode_transaksi,
				'penawaran_total'    => 0,
				'penawaran_pay'      => 0,
				'penawaran_discount' => $find_member->member_discount,
				'penawaran_profit'   => 0,
				'penawaran_status'   => 0,
				'penawaran_ket'      => 'Project',
				'user_id'       => user()->id,
				'member_id'     => $this->request->getPost('member_id'),
			]);
			if ($save) {
				set_cookie('penawaran', $this->m_penawaran->getInsertID(), 900);
				setcookie('penawaran', $this->m_penawaran->getInsertID(), 900);

				return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
			}
			session()->setFlashdata('gagal', 'Gagal Membuat Transaksi Baru');

			return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
		}
		if (!empty($this->request->getPost('submit_transaksi'))) {
			$formSubmit = $this->validate([
				'item_barang'   => 'required',
				'item_quantity' => 'required|integer',
				'item_discount' => 'permit_empty',
			]);
			if (!$formSubmit) {
				return redirect()->to('/transaction/marketing/kasir-penawaran')->withInput();
			}
			if (get_cookie('penawaran')) {
				// Cek apakah sudah ada item tersebut di database
				$check = $this->m_penawaran_detail->where('item_id', $this->request->getPost('item_barang'))->where('penawaran_id', get_cookie('penawaran'))->findAll();
				if (!empty($check)) {
					session()->setFlashdata('gagal', 'Barang Sudah Ada Di List, Gagal Menambahkan');

					return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
				}
				$item_barang = $this->m_item->find($this->request->getPost('item_barang'));
				$stock_sisa  = $item_barang->item_stock - $this->request->getPost('item_quantity');
				if ($stock_sisa < 0) {
					$kode_penawaran = $this->m_penawaran->where('id', get_cookie('penawaran'))->first();
					$request_order_data = $this->m_request_order->getAllOrderWhere($this->request->getPost('item_barang'), $kode_penawaran->penawaran_code);
					if ($request_order_data > 0) {
						foreach ($request_order_data as $data) {
							$this->m_request_order->delete($data->id);
						}
					}
					$this->m_request_order->save([
						'request_description' => "Request Kekurangan Barang Untuk Transaksi Project PO.$kode_penawaran->penawaran_code",
						'request_status' => 0,
						'request_total' => abs($stock_sisa),
						'request_po_code' => $kode_penawaran->penawaran_code,
						'item_id'             => $this->request->getPost('item_barang'),
						'user_id'             => user()->id,
					]);
				}
				// Perhitungan Total Belanjar
				$detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;

				// Perhitungan Besar Discount
				$discount_total = $this->request->getPost('item_discount') * $detail / 100;
				$after_discount = $detail - $discount_total;

				// Total Keuntungan
				$profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;
				$profit_after_discount = $profit_per_item - $discount_total;
				$total_profit    = $find_sale[0]->penawaran_profit + $profit_after_discount;

				$save_penawaran_detail = $this->m_penawaran_detail->save([
					'detail_total'    => $after_discount,
					'detail_before_discount' => $detail,
					'detail_value_discount' => $discount_total,
					'detail_percen_discount' => $this->request->getPost('item_discount'),
					'detail_quantity' => $this->request->getPost('item_quantity'),
					'user_id'         => user()->id,
					'item_id'         => $this->request->getPost('item_barang'),
					'penawaran_id'         => get_cookie('penawaran'),
				]);
				if ($save_penawaran_detail) {
					// Perhitungan Belanja Baru
					$get_all   = $this->m_penawaran_detail->where('penawaran_id', get_cookie('penawaran'))->findAll();
					$sub_tot_1 = 0;

					foreach ($get_all as $detail) {
						$sub_tot_1 = $sub_tot_1 + $detail->detail_total;
					}
					$discount    = $sub_tot_1 * $find_sale[0]->penawaran_discount / 100;
					$sub_tot_2   = $sub_tot_1 - $discount;
					$sub_tot_3   = $find_sale[0]->penawaran_handling + $sub_tot_2;
					$pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
					$grand_total = $sub_tot_3 + $pph;
					// End Perhitungan Belanja Baru

					$save_sale = $this->m_penawaran->save([
						'id'         => get_cookie('penawaran'),
						'penawaran_total' => $grand_total,
						'penawaran_profit' => $total_profit,
					]);
					if ($save_sale) {
						return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
					}
					session()->setFlashdata('gagal', 'Gagal Menambahkan Transaksi');

					return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
				}
				session()->setFlashdata('gagal', 'Gagal Menambahkan Detail Transaksi');

				return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
			}
			session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

			return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
		}
		if (!empty($this->request->getPost('batalkan_transaksi'))) {
			if (get_cookie('penawaran')) {
				$kode_penawaran = $this->m_penawaran->where('id', get_cookie('penawaran'))->first();
				$request_order_data = $this->m_request_order->getAllOrderWherePenawaranCode($kode_penawaran->penawaran_code);
				if ($request_order_data > 0) {
					foreach ($request_order_data as $data) {
						$this->m_request_order->delete($data->id);
					}
				}

				if ($this->m_penawaran->delete(get_cookie('penawaran'))) {
					session()->setFlashdata('berhasil', 'Transaksi Berhasil Dibatalkan');

					return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
				}
				session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi');

				return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
			}
			session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');
			return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
		}
		if (!empty($this->request->getPost('delete_item'))) {
			if (get_cookie('penawaran')) {
				// Ambil detail penjualan
				$detail_sale = $this->m_penawaran_detail->find($this->request->getPost('id_item'));
				// Ambil barang berdasarkan id item yang ada didetail penjualan
				$item_barang = $this->m_item->find($detail_sale->item_id);
				// Hitung stocknya jika dihapus
				$kode_penawaran = $this->m_penawaran->where('id', get_cookie('penawaran'))->first();
				$request_order_data = $this->m_request_order->getAllOrderWhere($detail_sale->item_id, $kode_penawaran->penawaran_code);
				if ($request_order_data > 0) {
					foreach ($request_order_data as $data) {
						$this->m_request_order->delete($data->id);
					}
				}

				// Perhitungan Total Belanjar
				$detail = $detail_sale->detail_quantity * $item_barang->item_sale;

				// Total Keuntungan
				$profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;
				$total_profit    = $find_sale[0]->penawaran_profit - $profit_per_item;
				// Perlu input itu ada stoknya, penawaran_total,penawaran_profit
				// Pertama ubah stocknya
				if ($this->m_penawaran_detail->delete($this->request->getPost('id_item'))) {
					// Perhitungan Belanja Baru
					$get_all   = $this->m_penawaran_detail->where('penawaran_id', get_cookie('penawaran'))->findAll();
					$sub_tot_1 = 0;

					foreach ($get_all as $detail) {
						$sub_tot_1 = $sub_tot_1 + $detail->detail_total;
					}
					$discount    = $sub_tot_1 * $find_sale[0]->penawaran_discount / 100;
					$sub_tot_2   = $sub_tot_1 - $discount;
					$sub_tot_3   = $find_sale[0]->penawaran_handling + $sub_tot_2;
					$pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
					$grand_total = $sub_tot_3 + $pph;
					// End Perhitungan Belanja Baru

					$save_update_sale = $this->m_penawaran->save([
						'id'          => $detail_sale->penawaran_id,
						'penawaran_total'  => $grand_total,
						'penawaran_profit' => $total_profit,
					]);
					if ($save_update_sale) {
						return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
					}
					session()->setFlashdata('gagal', 'Gagal Memperbaharui Transaksi');

					return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
				}
				session()->setFlashdata('gagal', 'Gagal Menghapus Barang');

				return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
			}
			session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

			return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
		}
		if (!empty($this->request->getPost('invoice'))) {
			if (get_cookie('penawaran')) {
				$save_update_status = $this->m_penawaran->save([
					'id'          => get_cookie('penawaran'),
					'penawaran_status' => 1,
				]);
				if ($save_update_status) {
					$find_member = $this->m_member->find($find_sale[0]->member_id);
					$find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
					$ttd_kiri    = $this->m_invoice->where('key', 'penawaran-kiri')->first();
					$ttd_tengah_satu  = $this->m_invoice->where('key', 'penawaran-tengah-satu')->first();
					$ttd_tengah_dua   = $this->m_invoice->where('key', 'penawaran-tengah-dua')->first();
					$ttd_kanan   = $this->m_invoice->where('key', 'penawaran-kanan')->first();
					$note        = $this->m_invoice->where('key', 'penawaran-note')->first();
					$data        = [
						'detail'     => $find_detail,
						'sale'       => $find_sale,
						'pph'        => $pph_model,
						'member'     => $find_member,
						'user'       => $find_user,
						'ttd_kiri'   => $ttd_kiri,
						'ttd_tengah_satu' => $ttd_tengah_satu,
						'ttd_tengah_dua'  => $ttd_tengah_dua,
						'ttd_kanan'  => $ttd_kanan,
						'note'       => $note,
					];
					set_cookie('penawaran', false, -900);
					delete_cookie('penawaran');
					$mpdf = new \Mpdf\Mpdf();
					$html = view('Invoice/invoice-transaksi-penawaran', $data);
					$mpdf->WriteHTML($html);
					$mpdf->showImageErrors = true;
					$this->response->setHeader('Content-Type', 'application/pdf');
					$mpdf->SetJS('this.print();');
					$mpdf->Output();
				}
			} else {
				session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

				return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
			}
		} else {
			return view('Admin/page/transaction-penawaran', $data);
		}
	}


	public function add_handling_report()
	{
		if (get_cookie('penawaran') || !empty($this->request->getPost('handling'))) {
			if (!empty($this->request->getPost('handling'))) {
				$id_transaksi = $this->request->getPost('id_transaksi');
			} else {
				$id_transaksi = get_cookie('penawaran');
			}

			$handling_real = $this->request->getPost('handling_tot');
			$pecah = explode(".", $handling_real);
			$handling_total = implode("", $pecah);

			$find      = $this->m_penawaran->where('id', $id_transaksi)->find();
			$pph_model = $this->m_pph->getAllPPh();

			// Perhitungan Belanja Baru
			$get_all   = $this->m_penawaran_detail->where('penawaran_id', $id_transaksi)->findAll();
			$sub_tot_1 = 0;

			foreach ($get_all as $detail) {
				$sub_tot_1 = $sub_tot_1 + $detail->detail_total;
			}
			$discount    = $sub_tot_1 * $find[0]->penawaran_discount / 100;
			$sub_tot_2   = $sub_tot_1 - $discount;
			$sub_tot_3   = $handling_total + $sub_tot_2;
			$pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
			$grand_total = $sub_tot_3 + $pph;
			// End Perhitungan Belanja Baru

			$save = $this->m_penawaran->save([
				'id'            => $id_transaksi,
				'penawaran_handling' => $handling_total,
				'penawaran_total'    => $grand_total,
				'penawaran_status' => 1,
			]);
			if ($save) {
				// echo json_encode(array("status" => TRUE));
				return redirect()->to('/transaction/marketing/search?penawaran_code=' . $find[0]->penawaran_code)->withCookies();
			}
			// echo json_encode(array("status" => FALSE));
			return redirect()->to('/transaction/marketing/search?penawaran_code=' . $find[0]->penawaran_code)->withCookies();
		}
	}
	public function add_handling()
	{
		if (get_cookie('penawaran') || !empty($this->request->getPost('handling'))) {
			if (!empty($this->request->getPost('handling'))) {
				$id_transaksi = $this->request->getPost('id_transaksi');
			} else {
				$id_transaksi = get_cookie('penawaran');
			}

			$handling_real = $this->request->getPost('handling_tot');
			$pecah = explode(".", $handling_real);
			$handling_total = implode("", $pecah);

			$find      = $this->m_penawaran->where('id', $id_transaksi)->find();
			$pph_model = $this->m_pph->getAllPPh();

			// Perhitungan Belanja Baru
			$get_all   = $this->m_penawaran_detail->where('penawaran_id', $id_transaksi)->findAll();
			$sub_tot_1 = 0;

			foreach ($get_all as $detail) {
				$sub_tot_1 = $sub_tot_1 + $detail->detail_total;
			}
			$discount    = $sub_tot_1 * $find[0]->penawaran_discount / 100;
			$sub_tot_2   = $sub_tot_1 - $discount;
			$sub_tot_3   = $handling_total + $sub_tot_2;
			$pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
			$grand_total = $sub_tot_3 + $pph;
			// End Perhitungan Belanja Baru

			$save = $this->m_penawaran->save([
				'id'            => $id_transaksi,
				'penawaran_handling' => $handling_total,
				'penawaran_total'    => $grand_total,
				'penawaran_status' => 1,
			]);
			if ($save) {
				// echo json_encode(array("status" => TRUE));
				return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
			}
			// echo json_encode(array("status" => FALSE));
			return redirect()->to('/transaction/marketing/kasir-penawaran')->withCookies();
		}
	}

	public function report_marketing()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('Project'),
		];
		$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			$find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
			$find_sale   = $this->m_sale->getAllSale($find_sale_code->id);
			$find_member = $this->m_member->find($find_sale[0]->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
			$pph_model   = $this->m_pph->getAllPPh();
			$ttd_kiri    = $this->m_invoice->where('key', 'project-kiri')->first();
			$ttd_tengah_satu  = $this->m_invoice->where('key', 'project-tengah-satu')->first();
			$ttd_tengah_dua   = $this->m_invoice->where('key', 'project-tengah-dua')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'project-kanan')->first();
			$note        = $this->m_invoice->where('key', 'project-note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'pph'        => $pph_model,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah_satu' => $ttd_tengah_satu,
				'ttd_tengah_dua'  => $ttd_tengah_dua,
				'ttd_kanan'  => $ttd_kanan,
				'note'       => $note,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-transaksi-project', $data);
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
		return view('Admin/page/report', $data);
	}

	public function list_penawaran()
	{
		$data = [
			'transaksi' => $this->m_penawaran->getAllPenawaranWhere('Project'),
			'validation'  => $this->validate,
		];
		$find_penawaran_code = $this->m_penawaran->where('penawaran_code', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			$save_update_status = $this->m_penawaran->save([
				'id'          => $find_penawaran_code->id,
				'penawaran_status' => 2,
			]);
			if ($save_update_status) {
				$find_detail = $this->m_penawaran_detail->getAllPenawaranDetail($find_penawaran_code->id);
				$find_sale   = $this->m_penawaran->getAllPenawaran($find_penawaran_code->id);
				$find_member = $this->m_member->find($find_sale[0]->member_id);
				$find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
				$pph_model   = $this->m_pph->getAllPPh();
				$ttd_kiri    = $this->m_invoice->where('key', 'penawaran-kiri')->first();
				$ttd_tengah_satu  = $this->m_invoice->where('key', 'penawaran-tengah-satu')->first();
				$ttd_tengah_dua   = $this->m_invoice->where('key', 'penawaran-tengah-dua')->first();
				$ttd_kanan   = $this->m_invoice->where('key', 'penawaran-kanan')->first();
				$note        = $this->m_invoice->where('key', 'penawaran-note')->first();
				$data        = [
					'detail'     => $find_detail,
					'sale'       => $find_sale,
					'pph'        => $pph_model,
					'member'     => $find_member,
					'user'       => $find_user,
					'ttd_kiri'   => $ttd_kiri,
					'ttd_tengah_satu' => $ttd_tengah_satu,
					'ttd_tengah_dua'  => $ttd_tengah_dua,
					'ttd_kanan'  => $ttd_kanan,
					'note'       => $note,
				];
				$mpdf = new \Mpdf\Mpdf();
				$html = view('Invoice/invoice-transaksi-penawaran', $data);
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
			$kode_penawaran = $this->m_penawaran->where('id', $find_penawaran_code->id)->first();
			$request_order_data = $this->m_request_order->getAllOrderWherePenawaranCode($kode_penawaran->penawaran_code);
			if ($request_order_data > 0) {
				foreach ($request_order_data as $data) {
					$this->m_request_order->delete($data->id);
				}
			}

			if ($this->m_penawaran->delete($find_penawaran_code->id)) {
				session()->setFlashdata('berhasil', 'Berhasil Menghapus Penawaran Yang Dipilih');

				return redirect()->to('/transaction/marketing/list-penawaran')->withCookies();
			}
			session()->setFlashdata('gagal', 'Gagal Menghapus Penawaran Yang Dipilih');
			return redirect()->to('/transaction/marketing/list-penawaran')->withCookies();
		}
		if (!empty($this->request->getPost('update_status_penawaran'))) {
			$this->m_penawaran->save([
				'id' => $find_penawaran_code->id,
				'penawaran_status' => $this->request->getPost('penawaran_status'),
			]);
			session()->setFlashdata('berhasil', 'Berhasil Mengubah Status Penawaran Yang Dipilih');
			return redirect()->to('/transaction/marketing/list-penawaran')->withCookies();
		}

		return view('Admin/page/report-penawaran', $data);
	}

	public function search()
	{
		if ($this->request->getGet('penawaran_code') !== null) {
			$penawaran_code      = $this->request->getGet('penawaran_code');
			$find_penawaran_code = $this->m_penawaran->where('penawaran_code', $penawaran_code)->first();
			if (!empty($find_penawaran_code) && $find_penawaran_code->penawaran_status != 2) {
				$count_member = $this->m_penawaran->where('member_id', $find_penawaran_code->user_id)->countAllResults();
				$find_detail  = $this->m_penawaran_detail->getAllPenawaranDetail($find_penawaran_code->id);
				$find_sale    = $this->m_penawaran->getAllPenawaran($find_penawaran_code->id);
				$pph_model    = $this->m_pph->getAllPPh();
				$data         = [
					'transaction' => $find_detail,
					'member'      => $this->m_member->findAll(),
					'validation'  => $this->validate,
					'item'        => $this->m_item->getAllItemWhere(),
					'find_sale'   => $find_sale,
					'pph'         => $pph_model,
					'count_user'  => $count_member,
				];
				if (!empty($this->request->getPost('submit_transaksi'))) {
					$formSubmit = $this->validate([
						'item_barang'   => 'required',
						'item_quantity' => 'required|integer',
						'item_discount' => 'permit_empty',
					]);
					if (!$formSubmit) {
						return redirect()->to('/transaction/marketing/list-penawaran')->withInput();
					}
					// Cek apakah sudah ada item tersebut di database
					$check = $this->m_penawaran_detail->where('item_id', $this->request->getPost('item_barang'))->where('penawaran_id', $find_penawaran_code->id)->findAll();
					if (!empty($check)) {
						session()->setFlashdata('gagal', 'Barang Yang  Dipilih Sudah Ada Dalam List Transaksi');

						return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
					}
					$item_barang = $this->m_item->find($this->request->getPost('item_barang'));
					$stock_sisa  = $item_barang->item_stock - $this->request->getPost('item_quantity');
					if ($stock_sisa < 0) {
						$kode_penawaran = $this->m_penawaran->where('id', $find_penawaran_code->id)->first();
						$request_order_data = $this->m_request_order->getAllOrderWhere($this->request->getPost('item_barang'), $kode_penawaran->penawaran_code);
						if ($request_order_data > 0) {
							foreach ($request_order_data as $data) {
								$this->m_request_order->delete($data->id);
							}
						}
						$this->m_request_order->save([
							'request_description' => "Request Kekurangan Barang Untuk Transaksi Project PO.$kode_penawaran->penawaran_code",
							'request_status' => 0,
							'request_total' => abs($stock_sisa),
							'request_po_code' => $kode_penawaran->penawaran_code,
							'item_id'             => $this->request->getPost('item_barang'),
							'user_id'             => user()->id,
						]);
					}
					// Perhitungan Total Belanjar
					$detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;

					// Perhitungan Besar Discount
					$discount_total = $this->request->getPost('item_discount') * $detail / 100;
					$after_discount = $detail - $discount_total;

					// Total Keuntungan
					$profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;
					$profit_after_discount = $profit_per_item - $discount_total;
					$total_profit    = $find_sale[0]->penawaran_profit + $profit_after_discount;


					// $total_discount = $find_sale[0]->penawaran_discount + $item_barang->item_discount;
					$save_penawaran_detail = $this->m_penawaran_detail->save([
						'detail_total'    => $after_discount,
                        'detail_before_discount' => $detail,
                        'detail_value_discount' => $discount_total,
                        'detail_percen_discount' => $this->request->getPost('item_discount'),
						'detail_quantity' => $this->request->getPost('item_quantity'),
						'user_id'         => user()->id,
						'item_id'         => $this->request->getPost('item_barang'),
						'penawaran_id'    => $find_penawaran_code->id,
					]);
					if ($save_penawaran_detail) {
						// Perhitungan Belanja Baru
						$get_all   = $this->m_penawaran_detail->where('penawaran_id', $find_penawaran_code->id)->findAll();
						$sub_tot_1 = 0;

						foreach ($get_all as $detail) {
							$sub_tot_1 = $sub_tot_1 + $detail->detail_total;
						}
						$discount    = $sub_tot_1 * $find_sale[0]->penawaran_discount / 100;
						$sub_tot_2   = $sub_tot_1 - $discount;
						$sub_tot_3   = $find_sale[0]->penawaran_handling + $sub_tot_2;
						$pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
						$grand_total = $sub_tot_3 + $pph;
						// End Perhitungan Belanja Baru

						$save_sale = $this->m_penawaran->save([
							'id'         => $find_penawaran_code->id,
							'penawaran_total' => $grand_total,
							// 'penawaran_discount' => $total_discount,
							'penawaran_profit' => $total_profit,
						]);
						if ($save_sale) {
							return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
						}
						session()->setFlashdata('gagal', 'Gagal Mengubah Transaksi Yang Dipilih');
						return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
					}
					session()->setFlashdata('gagal', 'Gagal Menambahkan Detail Transaksi');
					return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
				}
				if (!empty($this->request->getPost('delete_item'))) {
					// Ambil detail penjualan
					$detail_sale = $this->m_penawaran_detail->find($this->request->getPost('id_item'));
					// Ambil barang berdasarkan id item yang ada didetail penjualan
					$item_barang = $this->m_item->find($detail_sale->item_id);
					$kode_penawaran = $this->m_penawaran->where('id', $find_penawaran_code->id)->first();
					$request_order_data = $this->m_request_order->getAllOrderWhere($detail_sale->item_id, $kode_penawaran->penawaran_code);
					if ($request_order_data > 0) {
						foreach ($request_order_data as $data) {
							$this->m_request_order->delete($data->id);
						}
					}

					// Perhitungan Total Belanjar
					$detail = $detail_sale->detail_quantity * $item_barang->item_sale;

					// Total Keuntungan
					$profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;
					$total_profit    = $find_sale[0]->penawaran_profit - $profit_per_item;

					// Perlu input itu ada stoknya, penawaran_total,penawaran_profit
					// Pertama ubah stocknya
					if ($this->m_penawaran_detail->delete($this->request->getPost('id_item'))) {
						// Perhitungan Belanja Baru
						$get_all   = $this->m_penawaran_detail->where('penawaran_id', $find_penawaran_code->id)->findAll();
						$sub_tot_1 = 0;

						foreach ($get_all as $detail) {
							$sub_tot_1 = $sub_tot_1 + $detail->detail_total;
						}
						$discount    = $sub_tot_1 * $find_sale[0]->penawaran_discount / 100;
						$sub_tot_2   = $sub_tot_1 - $discount;
						$sub_tot_3   = $find_sale[0]->penawaran_handling + $sub_tot_2;
						$pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
						$grand_total = $sub_tot_3 + $pph;
						// End Perhitungan Belanja Baru

						$save_update_sale = $this->m_penawaran->save([
							'id'          => $find_penawaran_code->id,
							'penawaran_total'  => $grand_total,
							'penawaran_profit' => $total_profit,
						]);

						if ($save_update_sale) {
							return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
						}
						session()->setFlashdata('gagal', 'Gagal Memperbaharui Transaksi Yang Dipilih');

						return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
					}
					session()->setFlashdata('gagal', 'Gagal Menghapus Item Barang Yang Dipilih');

					return redirect()->to('/transaction/marketing/search?penawaran_code=' . $this->request->getGet('penawaran_code'))->withCookies();
				}
				if (!empty($this->request->getPost('invoice'))) {
					$save_update_status = $this->m_penawaran->save([
						'id'          => $find_penawaran_code->id,
						'penawaran_status' => 1,
					]);
					if ($save_update_status) {
						$find_member = $this->m_member->find($find_sale[0]->member_id);
						$find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
						$ttd_kiri    = $this->m_invoice->where('key', 'penawaran-kiri')->first();
						$ttd_tengah_satu  = $this->m_invoice->where('key', 'penawaran-tengah-satu')->first();
						$ttd_tengah_dua   = $this->m_invoice->where('key', 'penawaran-tengah-dua')->first();
						$ttd_kanan   = $this->m_invoice->where('key', 'penawaran-kanan')->first();
						$note        = $this->m_invoice->where('key', 'penawaran-note')->first();
						$data        = [
							'detail'     => $find_detail,
							'sale'       => $find_sale,
							'pph'        => $pph_model,
							'member'     => $find_member,
							'user'       => $find_user,
							'ttd_kiri'   => $ttd_kiri,
							'ttd_tengah_satu' => $ttd_tengah_satu,
							'ttd_tengah_dua'  => $ttd_tengah_dua,
							'ttd_kanan'  => $ttd_kanan,
							'note'       => $note,
						];
						$mpdf = new \Mpdf\Mpdf();
						$html = view('Invoice/invoice-transaksi-penawaran', $data);
						$mpdf->WriteHTML($html);
						$mpdf->showImageErrors = true;
						$this->response->setHeader('Content-Type', 'application/pdf');
						$mpdf->SetJS('this.print();');
						$mpdf->Output();
					}
				} else {
					return view('Admin/page/search-penawaran', $data);
				}
			} else {
				return redirect()->to('/transaction/marketing/list-penawaran');
			}
		} else {
			return redirect()->to('/transaction/marketing/list-penawaran');
		}
	}
}
