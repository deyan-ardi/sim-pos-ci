<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;

class TransactionProyek extends BaseController
{
	public function __construct()
	{
		$this->m_sale_detail = new SaleDetailModel();
		$this->m_sale        = new SaleModel();
	}
	public function index()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('General'),
		];
		$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			$find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
			$find_sale   = $this->m_sale->getAllSale($find_sale_code->id);
			$find_member = $this->m_member->find($find_sale[0]->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
			$pph_model   = $this->m_pph->getAllPPh();
			$ttd_kiri    = $this->m_invoice->where('key', 'kiri')->first();
			$ttd_tengah  = $this->m_invoice->where('key', 'tengah')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'kanan')->first();
			$ttd_bawah   = $this->m_invoice->where('key', 'bawah')->first();
			$note        = $this->m_invoice->where('key', 'note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'pph'        => $pph_model,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah' => $ttd_tengah,
				'ttd_kanan'  => $ttd_kanan,
				'ttd_bawah'  => $ttd_bawah,
				'note'       => $note,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-transaksi-general', $data);
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
		$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			$find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
			$find_sale   = $this->m_sale->getAllSale($find_sale_code->id);
			$find_member = $this->m_member->find($find_sale[0]->member_id);
			$find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
			$pph_model   = $this->m_pph->getAllPPh();
			$ttd_kiri    = $this->m_invoice->where('key', 'kiri')->first();
			$ttd_tengah  = $this->m_invoice->where('key', 'tengah')->first();
			$ttd_kanan   = $this->m_invoice->where('key', 'kanan')->first();
			$ttd_bawah   = $this->m_invoice->where('key', 'bawah')->first();
			$note        = $this->m_invoice->where('key', 'note')->first();
			$data        = [
				'detail'     => $find_detail,
				'sale'       => $find_sale,
				'pph'        => $pph_model,
				'member'     => $find_member,
				'user'       => $find_user,
				'ttd_kiri'   => $ttd_kiri,
				'ttd_tengah' => $ttd_tengah,
				'ttd_kanan'  => $ttd_kanan,
				'ttd_bawah'  => $ttd_bawah,
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
		return view('Admin/page/report-project-proyek', $data);
	}

	public function surat_jalan_general()
	{
		$data = [
			'transaksi' => $this->m_sale->getAllSaleWhere('General'),
		];
		$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			// $find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
			// $find_sale   = $this->m_sale->getAllSale($find_sale_code->id);
			// $find_member = $this->m_member->find($find_sale[0]->member_id);
			// $find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
			// $pph_model   = $this->m_pph->getAllPPh();
			// $ttd_kiri    = $this->m_invoice->where('key', 'kiri')->first();
			// $ttd_tengah  = $this->m_invoice->where('key', 'tengah')->first();
			// $ttd_kanan   = $this->m_invoice->where('key', 'kanan')->first();
			// $ttd_bawah   = $this->m_invoice->where('key', 'bawah')->first();
			// $note        = $this->m_invoice->where('key', 'note')->first();
			// $data        = [
			// 	'detail'     => $find_detail,
			// 	'sale'       => $find_sale,
			// 	'pph'        => $pph_model,
			// 	'member'     => $find_member,
			// 	'user'       => $find_user,
			// 	'ttd_kiri'   => $ttd_kiri,
			// 	'ttd_tengah' => $ttd_tengah,
			// 	'ttd_kanan'  => $ttd_kanan,
			// 	'ttd_bawah'  => $ttd_bawah,
			// 	'note'       => $note,
			// ];

			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/invoice-transaksi-general');
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
		$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->first();
		if (!empty($this->request->getPost('invoice'))) {
			// $find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
			// $find_sale   = $this->m_sale->getAllSale($find_sale_code->id);
			// $find_member = $this->m_member->find($find_sale[0]->member_id);
			// $find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
			// $pph_model   = $this->m_pph->getAllPPh();
			// $ttd_kiri    = $this->m_invoice->where('key', 'kiri')->first();
			// $ttd_tengah  = $this->m_invoice->where('key', 'tengah')->first();
			// $ttd_kanan   = $this->m_invoice->where('key', 'kanan')->first();
			// $ttd_bawah   = $this->m_invoice->where('key', 'bawah')->first();
			// $note        = $this->m_invoice->where('key', 'note')->first();
			// $data        = [
			// 	'detail'     => $find_detail,
			// 	'sale'       => $find_sale,
			// 	'pph'        => $pph_model,
			// 	'member'     => $find_member,
			// 	'user'       => $find_user,
			// 	'ttd_kiri'   => $ttd_kiri,
			// 	'ttd_tengah' => $ttd_tengah,
			// 	'ttd_kanan'  => $ttd_kanan,
			// 	'ttd_bawah'  => $ttd_bawah,
			// 	'note'       => $note,
			// ];
			$data = [
				'title' => "Test"
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Invoice/page/invoice-transaksi-general', $data);
			$mpdf->WriteHTML($html);
			$mpdf->SetDisplayMode('default');
			// $mpdf->SetWatermarkText("SUKSES");
			// $mpdf->showWatermarkText = true;
			$mpdf->showImageErrors = true;
			$this->response->setHeader('Content-Type', 'application/pdf');
			// $mpdf->AutoPrint(true);
			$mpdf->SetJS('this.print();');
			// $mpdf->Output('Invoice Transaction.pdf', 'I');
			$mpdf->Output();
		}
		// return view('Admin/page/surat-jalan-project-proyek', $data);
		return view('Invoice/invoice-transaksi-general');
	}
}
