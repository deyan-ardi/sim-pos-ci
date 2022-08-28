<?php

namespace App\Controllers;

use App\Models\InvoiceSettingModel;
use App\Models\ItemModel;
use App\Models\MemberModel;
use App\Models\PenawaranDetailModel;
use App\Models\PenawaranModel;
use App\Models\PphModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class Transaction extends BaseController
{
    public function __construct()
    {
        $this->validate      = \Config\Services::validation();
        $this->m_sale_detail = new SaleDetailModel();
        $this->m_sale        = new SaleModel();
        $this->m_item        = new ItemModel();
        $this->m_penawaran   = new PenawaranModel();
        $this->m_penawaran_detail = new PenawaranDetailModel();
        $this->m_member      = new MemberModel();
        $this->m_user        = new UserModel();
        $this->m_pph         = new PphModel();
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
        if (!get_cookie('transaction')) {
            $find_detail  = [];
            $find_sale    = null;
            $count_member = null;
        } else {
            $find_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction'));
            $find_sale   = $this->m_sale->getAllSale(get_cookie('transaction'));
            if (!empty($find_sale)) {
                $count_member = $this->m_sale->where('member_id', $find_sale[0]->user_id)->countAll();
            } else {
                $count_member = null;
            }
        }
        // set_cookie('_transaction', 1, time() + 900);
        $pph_model = $this->m_pph->getAllPPh();
        // Send Data
        $bulan        = $this->_month(date('m'));
        $tahun        = date('Y');
        $last_id      = $this->m_sale->orderBy('id', 'DESC')->first() == null ? 1 : $this->m_sale->orderBy('id', 'DESC')->first()->id + 1;
        $leading_kode = sprintf('%03d', $last_id);
        $kode_transaksi = "{$leading_kode}/PROJECT/DIN/{$bulan}/{$tahun}";
        $data = [
            'transaction' => $find_detail,
            'pph'         => $pph_model,
            'penawaran'   => $this->m_penawaran->getAllPenawaranWhereSuccess(),
            'validation'  => $this->validate,
            'item'        => $this->m_item->getAllItemWhere(),
            'find_sale'   => $find_sale,
            'count_user'  => $count_member,
        ];
        if (!empty($this->request->getPost('submit_penawaran'))) {
            $formSubmit = $this->validate([
                'penawaran_id' => 'required',
            ]);
            if (!$formSubmit) {
                return redirect()->to('/transaction/cashier/transaction-project')->withInput();
            }
            $find_penawaran = $this->m_penawaran->getAllPenawaranWhereIdSuccess($this->request->getPost('penawaran_id'));
            $find_member = $this->m_member->where('id', $find_penawaran[0]->member_id)->find();
            $save        = $this->m_sale->save([
                'sale_code'     => $kode_transaksi,
                'sale_penawaran_code' => $find_penawaran[0]->penawaran_code,
                'sale_total'    => $find_penawaran[0]->penawaran_total,
                'sale_pay'      => $find_penawaran[0]->penawaran_pay,
                'sale_discount' => $find_member[0]->member_discount,
                'sale_profit'   => $find_penawaran[0]->penawaran_profit,
                'sale_handling' => $find_penawaran[0]->penawaran_handling,
                'sale_status'   => 0,
                'sale_ket'      => 'Project',
                'user_id'       => user()->id,
                'member_id'     => $find_member[0]->id,
            ]);
            if ($save) {
                set_cookie('transaction', $this->m_sale->getInsertID(), 900);
                setcookie('transaction', $this->m_sale->getInsertID(), 900);
                $find_penawaran_detail = $this->m_penawaran_detail->getAllPenawaranDetail($find_penawaran[0]->id);
                foreach ($find_penawaran_detail as $detail_penawaran) {
                    $this->m_sale_detail->save([
                        'detail_total'    => $detail_penawaran->detail_total,
                        'detail_quantity' => $detail_penawaran->detail_quantity,
                        'user_id'         => $detail_penawaran->user_id,
                        'item_id'         => $detail_penawaran->item_id,
                        'sale_id'         => $this->m_sale->getInsertID(),
                    ]);
                }
                return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Membuat Transaksi Baru');
            return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
        }

        if (!empty($this->request->getPost('batalkan_transaksi'))) {
            if (get_cookie('transaction')) {
                if ($this->m_sale->delete(get_cookie('transaction'))) {
                    session()->setFlashdata('berhasil', 'Transaksi Berhasil Dibatalkan');
                    return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi');
                return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
            }
            session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

            return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
        }
        if (!empty($this->request->getPost('invoice'))) {
            if (get_cookie('transaction')) {
                $find_sale_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction'));
                $status = true;
                foreach ($find_sale_detail as $detail) {
                    $item = $this->m_item->getAllItem($detail->item_id, null);
                    if ($item[0]->item_stock - $detail->detail_quantity < 0) {
                        $status = false;
                        break;
                    }
                }
                if ($status) {
                    foreach ($find_sale_detail as $detail) {
                        $item = $this->m_item->getAllItem($detail->item_id, null);
                        if ($item[0]->item_stock - $detail->detail_quantity >= 0) {
                            $this->m_item->save([
                                'id' => $detail->item_id,
                                'item_stock' => $item[0]->item_stock - $detail->detail_quantity
                            ]);
                        }
                    }
                    $save_update_status = $this->m_sale->save([
                        'id'          => get_cookie('transaction'),
                        'sale_status' => 1,
                    ]);
                    if ($save_update_status) {
                        $find_member = $this->m_member->find($find_sale[0]->member_id);
                        $find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
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
                        // return view('Admin/page/invoice_transaction', $data);
                        set_cookie('transaction', false, -900);
                        delete_cookie('transaction');
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
                    session()->setFlashdata('gagal', 'Transaksi Tidak Dapat Dilanjutkan, Jumlah Stok Barang Belum Terpenuhi');
                    return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
                }
            } else {
                session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

                return redirect()->to('/transaction/cashier/transaction-project')->withCookies();
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
            $sale = $this->m_sale->where('id', $id_transaksi)->first();
            if ($this->request->getPost('bayar') - $sale->sale_total < 0) {
                return json_encode(['status' => false, 'message' => 'Uang Yang Dimasukkan Kurang']);
            }
            $save = $this->m_sale->save([
                'id'       => $id_transaksi,
                'sale_pay' => $this->request->getPost('bayar'),
            ]);
            if ($save) {
                return json_encode(['status' => true, "message" => "Transaksi Berhasil, Silahkan Cetak Invoice"]);
            } else {
                return json_encode(['status' => false, "message" => "Gagal Menyimpan Data"]);
            }
        }
    }


    public function report_kasir()
    {
        $data = [
            'transaksi' => $this->m_sale->getAllSaleWhere('Project'),
        ];
        $find_sale_code = $this->m_sale->where('sale_code', $this->request->getPost('id_transaksi'))->first();
        if (!empty($this->request->getPost('invoice'))) {
            $save_update_status = $this->m_sale->save([
                'id'          => $find_sale_code->id,
                'sale_status' => 1,
            ]);
            if ($save_update_status) {
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
            $find_sale_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
            $find_item        = $this->m_item->findAll();
            if (!empty($find_sale_detail)) {
                foreach ($find_sale_detail as $d) {
                    foreach ($find_item as $i) {
                        if ($d->item_id == $i->id) {
                            $this->m_item->save([
                                'id'         => $i->id,
                                'item_stock' => $i->item_stock + $d->detail_quantity,
                            ]);
                        }
                    }
                    $status = true;
                }
            } else {
                $status = true;
            }
            if ($status) {
                if ($this->m_sale->delete($find_sale_code->id)) {
                    session()->setFlashdata('berhasil', 'Berhasil Menghapus Transaksi Yang Dipilih');

                    return redirect()->to('/transaction/cashier/report')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Menghapus Transaksi Yang Dipilih');

                return redirect()->to('/transaction/cashier/report')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Transaksi Yang Dipilih');

            return redirect()->to('/transaction/cashier/report')->withCookies();
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
                // return view('Admin/page/invoice_transaction', $data);
                $mpdf = new \Mpdf\Mpdf();
                $html = view('Admin/page/invoice_transaction_penawaran', $data);
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
        return view('Admin/page/report-penawaran', $data);
    }
    public function search()
    {
        if ($this->request->getGet('sale_code') !== null) {
            $sale_code      = $this->request->getGet('sale_code');
            $find_sale_code = $this->m_sale->where('sale_code', $sale_code)->first();
            if (!empty($find_sale_code) && $find_sale_code->sale_status != 2 && $find_sale_code->sale_ket == "Project") {
                $count_member = $this->m_sale->where('member_id', $find_sale_code->user_id)->countAllResults();
                $find_detail  = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
                $find_sale    = $this->m_sale->getAllSale($find_sale_code->id);
                $pph_model    = $this->m_pph->getAllPPh();
                $data         = [
                    'transaction' => $find_detail,
                    'penawaran'   => $this->m_penawaran->getAllPenawaranWhereSuccess(),
                    'validation'  => $this->validate,
                    'item'        => $this->m_item->getAllItemWhere(),
                    'find_sale'   => $find_sale,
                    'pph'         => $pph_model,
                    'count_user'  => $count_member,
                ];
                if (!empty($this->request->getPost('batalkan_transaksi'))) {
                    if ($this->m_sale->delete($find_sale_code->id)) {
                        session()->setFlashdata('berhasil', 'Berhasil Membatalkan Transaksi Yang Dipilih');

                        return redirect()->to('/transaction/cashier/report')->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi Yang Dipilih');

                    return redirect()->to('/transaction/cashier/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                }
                if (!empty($this->request->getPost('invoice'))) {
                    $find_sale_detail = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
                    $status = true;
                    foreach ($find_sale_detail as $detail) {
                        $item = $this->m_item->getAllItem($detail->item_id, null);
                        if ($item[0]->item_stock - $detail->detail_quantity < 0) {
                            $status = false;
                            break;
                        }
                    }
                    if ($status) {
                        foreach ($find_sale_detail as $detail) {
                            $item = $this->m_item->getAllItem($detail->item_id, null);
                            if ($item[0]->item_stock - $detail->detail_quantity >= 0) {
                                $this->m_item->save([
                                    'id' => $detail->item_id,
                                    'item_stock' => $item[0]->item_stock - $detail->detail_quantity
                                ]);
                            }
                        }
                        $save_update_status = $this->m_sale->save([
                            'id'          => $find_sale_code->id,
                            'sale_status' => 1,
                        ]);
                        if ($save_update_status) {
                            $find_member = $this->m_member->find($find_sale[0]->member_id);
                            $find_user   = $this->m_user->getUserRole($find_sale[0]->user_id);
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
                        session()->setFlashdata('gagal', 'Transaksi Tidak Dapat Dilanjutkan, Jumlah Stok Barang Belum Terpenuhi');
                        return redirect()->to('/transaction/cashier/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                    }
                } else {
                    return view('Admin/page/search', $data);
                }
            } else {
                return redirect()->to('/transaction/cashier/report');
            }
        } else {
            return redirect()->to('/transaction/cashier/report');
        }
    }

    public function pengaturan()
    {
        if (in_groups('SUPER ADMIN') || in_groups('KASIR')) {
            $data = [
                'pph'        => $this->m_pph->getAllPPh(),
                'invoice'    => $this->m_invoice->findAll(),
                'validation' => $this->validate,
            ];
            if (!empty($this->request->getPost('update_status_order'))) {
                $save = $this->m_pph->save([
                    'id'        => $this->request->getPost('id_order'),
                    'pph_value' => $this->request->getPost('pph'),
                ]);
                if ($save) {
                    session()->setFlashdata('berhasil', 'PPh Berhasil Diperbaharui');

                    return redirect()->to('/transaction/pengaturan')->withCookies();
                }
                session()->setFlashdata('gagal', 'PPh Gagal Diperbaharui');

                return redirect()->to('/transaction/pengaturan')->withCookies();
            }
            if (!empty($this->request->getPost('update_pengaturan'))) {
                if ($this->request->getPost('pengaturan') == '' || empty($this->request->getPost('pengaturan'))) {
                    $value  = null;
                    $posisi = null;
                    $header = null;
                } else {
                    $value  = ucwords($this->request->getPost('pengaturan'));
                    $posisi = ucwords($this->request->getPost('posisi'));
                    $header = ucwords($this->request->getPost('header'));
                }

                $save = $this->m_invoice->save([
                    'id'       => $this->request->getPost('id_order'),
                    'value'    => $value,
                    'position' => $posisi,
                    'header'   => $header,
                ]);
                if ($save) {
                    session()->setFlashdata('berhasil', 'Pengaturan Berhasil Diperbaharui');

                    return redirect()->to('/transaction/pengaturan')->withCookies();
                }
                session()->setFlashdata('gagal', 'Pengaturan Gagal Diperbaharui');

                return redirect()->to('/transaction/pengaturan')->withCookies();
            }

            return view('Admin/page/pengaturan', $data);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }
}
