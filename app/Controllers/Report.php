<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MemberModel;
use App\Models\OrderModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Report extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_sale = new SaleModel();
		$this->m_sale_detail = new SaleDetailModel();
		$this->m_member = new MemberModel();
		$this->m_user = new UserModel();
		$this->m_order = new OrderModel();
	}
	public function index()
	{
		if (!empty($this->request->getPost('submit_sortir'))) {
			if ($this->request->getPost('order') == 1) {
				$sortir = 1;
				$find = $this->m_sale->getAllSale();
				$dari = null;
				$sampai = null;
			} else if ($this->request->getPost('order') == 2) {
				$sortir = 2;
				$find = $this->m_sale->getAllSale(null, date('Y'), null, "Y");
				$dari = null;
				$sampai = null;
			} else if ($this->request->getPost('order') == 3) {
				$sortir = 3;
				$find = $this->m_sale->getAllSale(null, date('Y-m'), null, "M");
				$dari = null;
				$sampai = null;
			} else if ($this->request->getPost('order') == 4) {
				$sortir = 4;
				$find = $this->m_sale->getAllSale(null, date('Y-m-d'), null, "D");
				$dari = null;
				$sampai = null;
			} else {
				$sortir = 5;
				if ($this->request->getPost('tgl_dari') >= $this->request->getPost('tgl_sampai')) {
					$dari = $this->request->getPost('tgl_sampai');
					$sampai = $this->request->getPost('tgl_dari');
				} else {
					$dari = $this->request->getPost('tgl_dari');
					$sampai = $this->request->getPost('tgl_sampai');
				}
				$find = $this->m_sale->getAllSale(null, $dari, $sampai, "C");
			}
		} else {
			$sortir = 1;
			$find = $this->m_sale->getAllSale();
			$dari = null;
			$sampai = null;
		}
		// JSON Data Send To Grafik
		$order = $this->m_order->getAllOrder();
		if ($order != null) {
			foreach ($order as $row) {
				$output_order[] = array(
					'date'  => $row->created_at,
					'price' => $row->order_total_item
				);
			}
		} else {
			$output_order[] = array();
		}
		if ($find != null) {
			foreach ($find as $row) {
				$output_transaksi[] = array(
					'date'  => $row->created_at,
					'price' => $row->sale_profit
				);
			}
		} else {
			$output_transaksi[] = array();
		}
		// End JSON Data
		$data = [
			'sortir' => $sortir,
			'tgl_dari' => $dari,
			'tgl_sampai' => $sampai,
			'validation' => $this->validate,
			'transaksi' => $find,
			'order' => $order,
			'transaksi_json' => json_encode($output_transaksi),
			'order_json' => json_encode($output_order),
		];
		if (!empty($this->request->getPost('invoice'))) {
			$find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->findAll();
			$find_sale = $this->m_sale->getAllSale($find_sale_code[0]->id);
			$find_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code[0]->id);
			$find_member = $this->m_member->find($find_sale[0]->member_id);
			$find_user = $this->m_user->getUserRole($find_sale[0]->user_id);
			$data = [
				'detail' => $find_detail,
				'sale' => $find_sale,
				'member' => $find_member,
				'user' => $find_user,
			];
			// return view('Admin/page/invoice_transaction', $data);
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Admin/page/invoice_transaction', $data);
			$mpdf->WriteHTML($html);
			$mpdf->SetWatermarkText("SUKSES");
			$mpdf->showWatermarkText = true;
			$mpdf->showImageErrors = true;
			$this->response->setHeader('Content-Type', 'application/pdf');
			// $mpdf->AutoPrint(true);
			// $mpdf->SetJS('this.print();');
			$mpdf->Output('Invoice Transaction.pdf', 'I');
			$mpdf->Output();
		} else if (!empty($this->request->getPost('submit_laporan'))) {
			if ($this->request->getPost('id_sortir') == 1) {
				$sortir = 1;
				$find = $this->m_sale->getAllSale();
			} else if ($this->request->getPost('id_sortir') == 2) {
				$sortir = 2;
				$find = $this->m_sale->getAllSale(null, date('Y'), null, "Y");
			} else if ($this->request->getPost('id_sortir') == 3) {
				$sortir = 3;
				$find = $this->m_sale->getAllSale(null, date('Y-m'), null, "M");
			} else if ($this->request->getPost('id_sortir') == 4) {
				$sortir = 4;
				$find = $this->m_sale->getAllSale(null, date('Y-m-d'), null, "D");
			} else {
				$sortir = 5;
				if ($this->request->getPost('dari') >= $this->request->getPost('sampai')) {
					$dari = $this->request->getPost('sampai');
					$sampai = $this->request->getPost('dari');
				} else {
					$dari = $this->request->getPost('dari');
					$sampai = $this->request->getPost('sampai');
				}
				$find = $this->m_sale->getAllSale(null, $dari, $sampai, "C");
			}
			$data = [
				'detail' => $find,
				'sortir' => $sortir,
				'tgl_dari' => $dari,
				'tgl_sampai' => $sampai,
			];
			// return view('Admin/page/invoice_payment', $data);
			$mpdf = new \Mpdf\Mpdf([
				'mode' => 'utf-8',
				'format' => 'A4-L',
				'orientation' => 'L'
			]);
			$html = view('Admin/page/invoice_payment', $data);
			$mpdf->WriteHTML($html);
			$mpdf->SetWatermarkText("PAYMENTS REPORT");
			$mpdf->showWatermarkText = true;
			$mpdf->showImageErrors = true;
			$this->response->setHeader('Content-Type', 'application/pdf');
			// $mpdf->AutoPrint(true);
			// $mpdf->SetJS('this.print();');
			$mpdf->Output('Invoice Transaction.pdf', 'I');
			$mpdf->Output();
		} else {
			return view('Admin/page/report_payment', $data);
		}
	}

	// public function fetch_data()
	// {
	// 	if (!empty($this->request->getPost('submit_sortir'))) {
	// 		if ($this->request->getPost('order') == 1) {

	// 			$find = $this->m_sale->getAllSale();
	// 		} else if ($this->request->getPost('order') == 2) {

	// 			$find = $this->m_sale->getAllSale(null, date('Y'), null, "Y");
	// 		} else if ($this->request->getPost('order') == 3) {

	// 			$find = $this->m_sale->getAllSale(null, date('Y-m'), null, "M");
	// 		} else if ($this->request->getPost('order') == 4) {
	// 			$find = $this->m_sale->getAllSale(null, date('Y-m-d'), null, "D");
	// 		} else {
	// 			if ($this->request->getPost('tgl_dari') >= $this->request->getPost('tgl_sampai')) {
	// 				$dari = $this->request->getPost('tgl_sampai');
	// 				$sampai = $this->request->getPost('tgl_dari');
	// 			} else {
	// 				$dari = $this->request->getPost('tgl_dari');
	// 				$sampai = $this->request->getPost('tgl_sampai');
	// 			}
	// 			$find = $this->m_sale->getAllSale(null, $dari, $sampai, "C");
	// 		}
	// 	} else {
	// 		$find = $this->m_sale->getAllSale();

	// 	}

	// }
}
