<?php

namespace App\Controllers;

use App\Models\InvoiceSettingModel;
use App\Models\MemberModel;
use App\Models\OrderModel;
use App\Models\PenawaranDetailModel;
use App\Models\PenawaranModel;
use App\Models\PphModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Report extends BaseController
{
    public function __construct()
    {
        $this->validate      = \Config\Services::validation();
        $this->m_sale        = new SaleModel();
        $this->m_sale_detail = new SaleDetailModel();
        $this->m_member      = new MemberModel();
        $this->m_user        = new UserModel();
        $this->m_order       = new OrderModel();
        $this->m_pph         = new PphModel();
        $this->m_penawaran   = new PenawaranModel();
        $this->m_penawaran_detail = new PenawaranDetailModel();
        $this->m_invoice = new InvoiceSettingModel();
    }

    public function index()
    {
        if (!empty($this->request->getPost('submit_sortir'))) {
            if ($this->request->getPost('order') == 1) {
                $sortir = 1;
                $find   = $this->m_sale->getAllSale();
                $dari   = null;
                $sampai = null;
            } elseif ($this->request->getPost('order') == 2) {
                $sortir = 2;
                $find   = $this->m_sale->getAllSale(null, date('Y'), null, 'Y');
                $dari   = null;
                $sampai = null;
            } elseif ($this->request->getPost('order') == 3) {
                $sortir = 3;
                $find   = $this->m_sale->getAllSale(null, date('Y-m'), null, 'M');
                $dari   = null;
                $sampai = null;
            } elseif ($this->request->getPost('order') == 4) {
                $sortir = 4;
                $find   = $this->m_sale->getAllSale(null, date('Y-m-d'), null, 'D');
                $dari   = null;
                $sampai = null;
            } else {
                $sortir = 5;
                if ($this->request->getPost('tgl_dari') >= $this->request->getPost('tgl_sampai')) {
                    $dari   = $this->request->getPost('tgl_sampai');
                    $sampai = $this->request->getPost('tgl_dari');
                } else {
                    $dari   = $this->request->getPost('tgl_dari');
                    $sampai = $this->request->getPost('tgl_sampai');
                }
                $find = $this->m_sale->getAllSale(null, $dari, $sampai, 'C');
            }
        } else {
            $sortir = 1;
            $find   = $this->m_sale->getAllSale();
            $dari   = null;
            $sampai = null;
        }
        // JSON Data Send To Grafik
        $order = $this->m_order->getAllOrder();
        $output_order[] = [];
        if ($order !== null) {
            foreach ($order as $row) {
                $output_order[] = [
                    'date'  => $row->created_at,
                    'price' => $row->order_total_item,
                ];
            }
        }
        $output_transaksi[] = [];
        if ($find !== null) {
            foreach ($find as $row) {
                $output_transaksi[] = [
                    'date'  => $row->created_at,
                    'price' => $row->sale_profit,
                ];
            }
        }
        // End JSON Data
        $data = [
            'sortir'         => $sortir,
            'tgl_dari'       => $dari,
            'tgl_sampai'     => $sampai,
            'validation'     => $this->validate,
            'transaksi'      => $find,
            'order'          => $order,
            'transaksi_json' => json_encode($output_transaksi),
            'order_json'     => json_encode($output_order),
        ];
        if (!empty($this->request->getPost('invoice'))) {
            $find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->findAll();
            $find_sale      = $this->m_sale->getAllSale($find_sale_code[0]->id);
            $find_detail    = $this->m_sale_detail->getAllSaleDetail($find_sale_code[0]->id);
            $find_member    = $this->m_member->find($find_sale[0]->member_id);
            $find_user      = $this->m_user->getUserRole($find_sale[0]->user_id);
            $pph_model   = $this->m_pph->getAllPPh();

            if ($find_sale[0]->sale_ket == "General") {
                $ttd_kiri    = $this->m_invoice->where('key', 'general-kiri')->first();
                $ttd_tengah_satu  = $this->m_invoice->where('key', 'general-tengah-satu')->first();
                $ttd_tengah_dua   = $this->m_invoice->where('key', 'general-tengah-dua')->first();
                $ttd_kanan   = $this->m_invoice->where('key', 'general-kanan')->first();
                $note        = $this->m_invoice->where('key', 'general-note')->first();
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
                $html = view('Invoice/invoice-transaksi-general', $data);
            } else {
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
            }
            $mpdf->WriteHTML($html);
            // $mpdf->SetWatermarkText("SUKSES");
            // $mpdf->showWatermarkText = true;
            $mpdf->showImageErrors = true;
            $this->response->setHeader('Content-Type', 'application/pdf');
            // $mpdf->AutoPrint(true);
            // $mpdf->SetJS('this.print();');
            $mpdf->Output('Invoice Transaction.pdf', 'I');
            $mpdf->Output();
        } elseif (!empty($this->request->getPost('submit_laporan'))) {
            if ($this->request->getPost('id_sortir') == 1) {
                $sortir = 1;
                $find   = $this->m_sale->getAllSale();
            } elseif ($this->request->getPost('id_sortir') == 2) {
                $sortir = 2;
                $find   = $this->m_sale->getAllSale(null, date('Y'), null, 'Y');
            } elseif ($this->request->getPost('id_sortir') == 3) {
                $sortir = 3;
                $find   = $this->m_sale->getAllSale(null, date('Y-m'), null, 'M');
            } elseif ($this->request->getPost('id_sortir') == 4) {
                $sortir = 4;
                $find   = $this->m_sale->getAllSale(null, date('Y-m-d'), null, 'D');
            } else {
                $sortir = 5;
                if ($this->request->getPost('dari') >= $this->request->getPost('sampai')) {
                    $dari   = $this->request->getPost('sampai');
                    $sampai = $this->request->getPost('dari');
                } else {
                    $dari   = $this->request->getPost('dari');
                    $sampai = $this->request->getPost('sampai');
                }
                $find = $this->m_sale->getAllSale(null, $dari, $sampai, 'C');
            }
            $data = [
                'detail'     => $find,
                'sortir'     => $sortir,
                'tgl_dari'   => $dari,
                'tgl_sampai' => $sampai,
            ];
            // return view('Admin/page/invoice_payment', $data);
            $mpdf = new \Mpdf\Mpdf([
                'mode'        => 'utf-8',
                'format'      => 'A4-L',
                'orientation' => 'L',
            ]);
            $html = view('Invoice/invoice-transaksi-umum', $data);
            $mpdf->WriteHTML($html);
            $mpdf->SetWatermarkText('PAYMENTS REPORT');
            $mpdf->showWatermarkText = true;
            $mpdf->showImageErrors   = true;
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
