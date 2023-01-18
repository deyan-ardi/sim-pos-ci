<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InvoiceSettingModel;
use App\Models\ItemModel;
use App\Models\MemberModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class TransactionProyek extends BaseController
{
	protected $m_sale_detail;
	protected $m_sale;
	protected $m_item;
	protected $m_member;
	protected $m_user;
	protected $m_invoice;
	protected $validate;
	public function __construct()
	{
		$this->m_sale_detail = new SaleDetailModel();
		$this->m_sale        = new SaleModel();
		$this->m_item  = new ItemModel();
		$this->m_member = new MemberModel();
		$this->m_user = new UserModel();
		$this->m_invoice = new InvoiceSettingModel();
		$this->validate   = \Config\Services::validation();
	}
	public function index()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('General'),
		];
		$find_sale = $this->m_sale->where('id', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			if ($this->request->getPost('checkbox_data') != NULL) {
				for ($i = 0; $i < count($this->request->getPost('checkbox_data')); $i++) {
					$find = $this->m_sale_detail->where('id', $this->request->getPost('checkbox_data')[$i])->first();
					if (!empty($find) && $find->detail_send_status == 0) {
						$this->m_sale_detail->save([
							'id' => $this->request->getPost('checkbox_data')[$i],
							'detail_send_status' => 1,
							'detail_send_address' => $this->request->getPost('alamat'),
							'detail_send_estimate' => $this->request->getPost('estimasi'),
						]);
					}
				}
				$this->m_sale->save([
					'id' => $find_sale->id,
					'sale_send_status' => 1,
				]);
				session()->setFlashdata('berhasil', 'Pengaturan SPPB Disimpan');
				return redirect()->to('/sppb/transaction-general')->withCookies();
			} else {
				session()->setFlashdata('gagal', 'Tidak Dapat Mencetak SPPB, Barang Pesanan Tidak Dicheklist');
				return redirect()->to('/sppb/transaction-general')->withCookies();
			}
		}
		if (!empty($this->request->getPost('invoice-cetak'))) {
			$find_detail = $this->m_sale_detail->getAllSaleDetailWhere($find_sale->id);
			$find_member = $this->m_member->find($find_sale->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale->user_id);
			$ttd_kiri    = $this->m_invoice->where('key', 'sppb-kiri')->first();
			$ttd_tengah  = $this->m_invoice->where('key', 'sppb-tengah')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'sppb-kanan')->first();
			$note        = $this->m_invoice->where('key', 'sppb-note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah' => $ttd_tengah,
				'ttd_kanan'  => $ttd_kanan,
				'note'       => $note,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-sppb', $data);
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
		return view('Admin/page/report-general-proyek', $data);
	}

	public function project()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('Project'),
		];
		$find_sale = $this->m_sale->where('id', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			if ($this->request->getPost('checkbox_data') != NULL) {
				for ($i = 0; $i < count($this->request->getPost('checkbox_data')); $i++) {
					$find = $this->m_sale_detail->where('id', $this->request->getPost('checkbox_data')[$i])->first();
					if (!empty($find) && $find->detail_send_status == 0) {
						$this->m_sale_detail->save([
							'id' => $this->request->getPost('checkbox_data')[$i],
							'detail_send_status' => 1,
							'detail_send_address' => $this->request->getPost('alamat'),
							'detail_send_estimate' => $this->request->getPost('estimasi'),
						]);
					}
				}
				$this->m_sale->save([
					'id' => $find_sale->id,
					'sale_send_status' => 1,
				]);
				session()->setFlashdata('berhasil', 'Pengaturan SPPB Disimpan');
				return redirect()->to('/sppb/transaction-general')->withCookies();
			} else {
				session()->setFlashdata('gagal', 'Tidak Dapat Mencetak SPPB, Barang Pesanan Tidak Dicheklist');
				return redirect()->to('/sppb/transaction-general')->withCookies();
			}
		}
		if (!empty($this->request->getPost('invoice-cetak'))) {
			$find_detail = $this->m_sale_detail->getAllSaleDetailWhere($find_sale->id);
			$find_member = $this->m_member->find($find_sale->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale->user_id);
			$ttd_kiri    = $this->m_invoice->where('key', 'sppb-kiri')->first();
			$ttd_tengah  = $this->m_invoice->where('key', 'sppb-tengah')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'sppb-kanan')->first();
			$note        = $this->m_invoice->where('key', 'sppb-note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah' => $ttd_tengah,
				'ttd_kanan'  => $ttd_kanan,
				'note'       => $note,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-sppb', $data);
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
		return view('Admin/page/report-project-proyek', $data);
	}

	public function detail_sale_sppb()
	{
		$data = [
			'sale_id' => $this->request->getPost('id'),
			'sale_detail' => $this->m_sale_detail->getAllSaleDetail($this->request->getPost('id')),
			'validation' => $this->validate,
		];
		// dd($data, $data['items'][0]->category_id);
		return view('Admin/page/_report_modal_sppb', $data);
	}

	public function surat_jalan_general()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('General'),
		];
		$find_sale = $this->m_sale->where('id', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			$this->m_sale->save([
				'id' => $find_sale->id,
				'sale_send_status' => 2,
			]);

			$find_detail = $this->m_sale_detail->getAllSaleDetailWhere($find_sale->id);
			$find_member = $this->m_member->find($find_sale->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale->user_id);
			$ttd_kiri    = $this->m_invoice->where('key', 'surat-jalan-kiri')->first();
			$ttd_tengah_satu  = $this->m_invoice->where('key', 'surat-jalan-tengah-satu')->first();
			$ttd_tengah_dua  = $this->m_invoice->where('key', 'surat-jalan-tengah-dua')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'surat-jalan-kanan')->first();
			$note        = $this->m_invoice->where('key', 'surat-jalan-note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah_satu' => $ttd_tengah_satu,
				'ttd_tengah_dua' => $ttd_tengah_dua,
				'ttd_kanan'  => $ttd_kanan,
				'note'       => $note,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-surat-jalan', $data);
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
		return view('Admin/page/surat-jalan-general-proyek', $data);
	}

	public function surat_jalan_project()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('Project'),
		];
		$find_sale = $this->m_sale->where('id', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			$this->m_sale->save([
				'id' => $find_sale->id,
				'sale_send_status' => 2,
			]);

			$find_detail = $this->m_sale_detail->getAllSaleDetailWhere($find_sale->id);
			$find_member = $this->m_member->find($find_sale->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale->user_id);
			$ttd_kiri    = $this->m_invoice->where('key', 'surat-jalan-kiri')->first();
			$ttd_tengah_satu  = $this->m_invoice->where('key', 'surat-jalan-tengah-satu')->first();
			$ttd_tengah_dua  = $this->m_invoice->where('key', 'surat-jalan-tengah-dua')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'surat-jalan-kanan')->first();
			$note        = $this->m_invoice->where('key', 'surat-jalan-note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah_satu' => $ttd_tengah_satu,
				'ttd_tengah_dua' => $ttd_tengah_dua,
				'ttd_kanan'  => $ttd_kanan,
				'note'       => $note,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-surat-jalan', $data);
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
		return view('Admin/page/surat-jalan-project-proyek', $data);
	}
}
