<?php

namespace App\Controllers;

use App\Models\InvoiceSettingModel;
use App\Models\ItemModel;
use App\Models\MemberModel;
use App\Models\PphModel;
use App\Models\SaleDetailModel;
use App\Models\SaleModel;
use App\Models\UserModel;

class GeneralTransaction extends BaseController
{
    public function __construct()
    {
        $this->validate      = \Config\Services::validation();
        $this->m_sale_detail = new SaleDetailModel();
        $this->m_sale        = new SaleModel();
        $this->m_item        = new ItemModel();
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
        if (!get_cookie('transaction-general')) {
            $find_detail  = [];
            $find_sale    = null;
            $count_member = null;
        } else {
            $find_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction-general'));
            $find_sale   = $this->m_sale->getAllSale(get_cookie('transaction-general'));
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
        $kode_transaksi = "{$leading_kode}/GENERAL/DIN/{$bulan}/{$tahun}";
        $data = [
            'transaction' => $find_detail,
            'pph'         => $pph_model,
            'member'      => $this->m_member->getMemberWhere(1),
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
                return redirect()->to('/transaction-general')->withInput();
            }
            $find_member = $this->m_member->find($this->request->getPost('member_id'));
            $save        = $this->m_sale->save([
                'sale_code'     => $kode_transaksi,
                'sale_total'    => 0,
                'sale_pay'      => 0,
                'sale_discount' => $find_member->member_discount,
                'sale_profit'   => 0,
                'sale_status'   => 0,
                'sale_ket'      => 'General',
                'user_id'       => user()->id,
                'member_id'     => $this->request->getPost('member_id'),
            ]);
            if ($save) {
                set_cookie('transaction-general', $this->m_sale->getInsertID(), 900);
                setcookie('transaction-general', $this->m_sale->getInsertID(), 900);

                return redirect()->to('/transaction-general')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Membuat Transaksi Baru');

            return redirect()->to('/transaction-general')->withCookies();
        }
        if (!empty($this->request->getPost('submit_transaksi'))) {
            $formSubmit = $this->validate([
                'item_barang'   => 'required',
                'item_quantity' => 'required|integer',
            ]);
            if (!$formSubmit) {
                return redirect()->to('/transaction-general')->withInput();
            }
            if (get_cookie('transaction-general')) {
                // Cek apakah sudah ada item tersebut di database
                $check = $this->m_sale_detail->where('item_id', $this->request->getPost('item_barang'))->where('sale_id', get_cookie('transaction-general'))->findAll();
                if (!empty($check)) {
                    session()->setFlashdata('gagal', 'Barang Sudah Ada Di List, Gagal Menambahkan');

                    return redirect()->to('/transaction-general')->withCookies();
                }
                $item_barang = $this->m_item->find($this->request->getPost('item_barang'));
                $stock_sisa  = $item_barang->item_stock - $this->request->getPost('item_quantity');
                if ($stock_sisa < 0) {
                    session()->setFlashdata('gagal', 'Stok Barang Yang Tersedia Tidak Mencukupi');

                    return redirect()->to('/transaction-general')->withCookies();
                }
                // Perhitungan Total Belanjar
                $detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;

                // Total Keuntungan
                $profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;
                $total_profit    = $find_sale[0]->sale_profit + $profit_per_item;
                // $total_discount = $find_sale[0]->sale_discount + $item_barang->item_discount;
                $save_sale_detail = $this->m_sale_detail->save([
                    'detail_total'    => $detail,
                    'detail_quantity' => $this->request->getPost('item_quantity'),
                    'user_id'         => user()->id,
                    'item_id'         => $this->request->getPost('item_barang'),
                    'sale_id'         => get_cookie('transaction-general'),
                ]);
                if ($save_sale_detail) {
                    $save_item = $this->m_item->save([
                        'id'         => $item_barang->id,
                        'item_stock' => $stock_sisa,
                    ]);
                    if ($save_item) {

                        // Perhitungan Belanja Baru
                        $get_all   = $this->m_sale_detail->where('sale_id', get_cookie('transaction-general'))->findAll();
                        $sub_tot_1 = 0;

                        foreach ($get_all as $detail) {
                            $sub_tot_1 = $sub_tot_1 + $detail->detail_total;
                        }
                        $discount    = $sub_tot_1 * $find_sale[0]->sale_discount / 100;
                        $sub_tot_2   = $sub_tot_1 - $discount;
                        $sub_tot_3   = $find_sale[0]->sale_handling + $sub_tot_2;
                        $pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
                        $grand_total = $sub_tot_3 + $pph;
                        // End Perhitungan Belanja Baru

                        $save_sale = $this->m_sale->save([
                            'id'         => get_cookie('transaction-general'),
                            'sale_total' => $grand_total,
                            // 'sale_discount' => $total_discount,
                            'sale_profit' => $total_profit,
                        ]);
                        if ($save_sale) {
                            return redirect()->to('/transaction-general')->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Gagal Menambahkan Transaksi');

                        return redirect()->to('/transaction-general')->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Mengurangkan Stok Item');

                    return redirect()->to('/transaction-general')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Menambahkan Detail Transaksi');

                return redirect()->to('/transaction-general')->withCookies();
            }
            session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

            return redirect()->to('/transaction-general')->withCookies();
        }
        if (!empty($this->request->getPost('batalkan_transaksi'))) {
            if (get_cookie('transaction-general')) {
                $find_sale_detail = $this->m_sale_detail->getAllSaleDetail(get_cookie('transaction-general'));
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
                    if ($this->m_sale->delete(get_cookie('transaction-general'))) {
                        session()->setFlashdata('berhasil', 'Transaksi Berhasil Dibatalkan');

                        return redirect()->to('/transaction-general')->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi');

                    return redirect()->to('/transaction-general')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok');

                return redirect()->to('/transaction-general')->withCookies();
            }
            session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

            return redirect()->to('/transaction-general')->withCookies();
        }
        if (!empty($this->request->getPost('delete_item'))) {
            if (get_cookie('transaction-general')) {

                // Ambil detail penjualan
                $detail_sale = $this->m_sale_detail->find($this->request->getPost('id_item'));
                // Ambil barang berdasarkan id item yang ada didetail penjualan
                $item_barang = $this->m_item->find($detail_sale->item_id);
                // Hitung stocknya jika dihapus
                $stock_sisa = $item_barang->item_stock + $detail_sale->detail_quantity;

                // Perhitungan Total Belanjar
                $detail = $detail_sale->detail_quantity * $item_barang->item_sale;

                // Total Keuntungan
                $profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;
                $total_profit    = $find_sale[0]->sale_profit - $profit_per_item;
                // Perlu input itu ada stoknya, sale_total,sale_profit
                // Pertama ubah stocknya
                $save_update_stock = $this->m_item->save([
                    'id'         => $detail_sale->item_id,
                    'item_stock' => $stock_sisa,
                ]);
                if ($save_update_stock) {
                    if ($this->m_sale_detail->delete($this->request->getPost('id_item'))) {

                        // Perhitungan Belanja Baru
                        $get_all   = $this->m_sale_detail->where('sale_id', get_cookie('transaction-general'))->findAll();
                        $sub_tot_1 = 0;

                        foreach ($get_all as $detail) {
                            $sub_tot_1 = $sub_tot_1 + $detail->detail_total;
                        }
                        $discount    = $sub_tot_1 * $find_sale[0]->sale_discount / 100;
                        $sub_tot_2   = $sub_tot_1 - $discount;
                        $sub_tot_3   = $find_sale[0]->sale_handling + $sub_tot_2;
                        $pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
                        $grand_total = $sub_tot_3 + $pph;
                        // End Perhitungan Belanja Baru

                        $save_update_sale = $this->m_sale->save([
                            'id'          => $detail_sale->sale_id,
                            'sale_total'  => $grand_total,
                            'sale_profit' => $total_profit,
                        ]);

                        if ($save_update_sale) {
                            return redirect()->to('/transaction-general')->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Gagal Memperbaharui Transaksi');

                        return redirect()->to('/transaction-general')->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Menghapus Barang');

                    return redirect()->to('/transaction-general')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');

                return redirect()->to('/transaction-general')->withCookies();
            }
            session()->setFlashdata('gagal', 'Session Transaksi Habis, Transaksi Tersimpan Sebagai Draft Di Menu Laporan Transaksi');

            return redirect()->to('/transaction-general')->withCookies();
        }
        if (!empty($this->request->getPost('invoice'))) {
            if (get_cookie('transaction-general')) {
                $save_update_status = $this->m_sale->save([
                    'id'          => get_cookie('transaction-general'),
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
                    set_cookie('transaction-general', false, 900);
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

                return redirect()->to('/transaction-general')->withCookies();
            }
        } else {
            return view('Admin/page/transaction-general', $data);
        }
    }

    public function validation_payment()
    {
        if (get_cookie('transaction-general') || !empty($this->request->getPost('cetak_ulang'))) {
            if (!empty($this->request->getPost('cetak_ulang'))) {
                $id_transaksi = $this->request->getPost('id_transaksi');
            } else {
                $id_transaksi = get_cookie('transaction-general');
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

    public function add_handling_report()
    {
        if (get_cookie('transaction-general') || !empty($this->request->getPost('handling'))) {
            if (!empty($this->request->getPost('handling'))) {
                $id_transaksi = $this->request->getPost('id_transaksi');
            } else {
                $id_transaksi = get_cookie('transaction-general');
            }
            $find      = $this->m_sale->where('id', $id_transaksi)->find();
            $pph_model = $this->m_pph->getAllPPh();

            // Perhitungan Belanja Baru
            $get_all   = $this->m_sale_detail->where('sale_id', $id_transaksi)->findAll();
            $sub_tot_1 = 0;

            foreach ($get_all as $detail) {
                $sub_tot_1 = $sub_tot_1 + $detail->detail_total;
            }
            $discount    = $sub_tot_1 * $find[0]->sale_discount / 100;
            $sub_tot_2   = $sub_tot_1 - $discount;
            $sub_tot_3   = $this->request->getPost('handling_tot') + $sub_tot_2;
            $pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
            $grand_total = $sub_tot_3 + $pph;
            // End Perhitungan Belanja Baru

            $save = $this->m_sale->save([
                'id'            => $id_transaksi,
                'sale_handling' => $this->request->getPost('handling_tot'),
                'sale_total'    => $grand_total,
            ]);
            if ($save) {
                // echo json_encode(array("status" => TRUE));
                return redirect()->to('/transaction-general/report/search?sale_code=' . $find[0]->sale_code)->withCookies();
            }
            // echo json_encode(array("status" => FALSE));
            return redirect()->to('/transaction-general/report/search?sale_code=' . $find[0]->sale_code)->withCookies();
        }
    }

    public function add_handling()
    {
        if (get_cookie('transaction-general') || !empty($this->request->getPost('handling'))) {
            if (!empty($this->request->getPost('handling'))) {
                $id_transaksi = $this->request->getPost('id_transaksi');
            } else {
                $id_transaksi = get_cookie('transaction-general');
            }
            $find      = $this->m_sale->where('id', $id_transaksi)->find();
            $pph_model = $this->m_pph->getAllPPh();

            // Perhitungan Belanja Baru
            $get_all   = $this->m_sale_detail->where('sale_id', $id_transaksi)->findAll();
            $sub_tot_1 = 0;

            foreach ($get_all as $detail) {
                $sub_tot_1 = $sub_tot_1 + $detail->detail_total;
            }
            $discount    = $sub_tot_1 * $find[0]->sale_discount / 100;
            $sub_tot_2   = $sub_tot_1 - $discount;
            $sub_tot_3   = $this->request->getPost('handling_tot') + $sub_tot_2;
            $pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
            $grand_total = $sub_tot_3 + $pph;
            // End Perhitungan Belanja Baru

            $save = $this->m_sale->save([
                'id'            => $id_transaksi,
                'sale_handling' => $this->request->getPost('handling_tot'),
                'sale_total'    => $grand_total,
            ]);

            if ($save) {
                // echo json_encode(array("status" => TRUE));
                return redirect()->to('/transaction-general')->withCookies();
            }
            // echo json_encode(array("status" => FALSE));
            return redirect()->to('/transaction-general')->withCookies();
        }
    }

    public function report()
    {
        $data = [
            'transaksi' => $this->m_sale->getAllSaleWhere('General'),
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
                set_cookie('transaction-general', false, 900);
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

                    return redirect()->to('/transaction-general/report')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Menghapus Transaksi Yang Dipilih');

                return redirect()->to('/transaction-general/report')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Transaksi Yang Dipilih');

            return redirect()->to('/transaction-general/report')->withCookies();
        }

        return view('Admin/page/report-general', $data);
    }

    public function search()
    {
        if ($this->request->getGet('sale_code') !== null) {
            $sale_code      = $this->request->getGet('sale_code');
            $find_sale_code = $this->m_sale->where('sale_code', $sale_code)->first();
            if (!empty($find_sale_code) && $find_sale_code->sale_status != 1 && $find_sale_code->sale_ket == "General") {
                $count_member = $this->m_sale->where('member_id', $find_sale_code->user_id)->countAllResults();
                $find_detail  = $this->m_sale_detail->getAllSaleDetail($find_sale_code->id);
                $find_sale    = $this->m_sale->getAllSale($find_sale_code->id);
                $pph_model    = $this->m_pph->getAllPPh();
                $data         = [
                    'transaction' => $find_detail,
                    'pph'         => $pph_model,
                    'member'      => $this->m_member->findAll(),
                    'validation'  => $this->validate,
                    'item'        => $this->m_item->getAllItemWhere(),
                    'find_sale'   => $find_sale,
                    'count_user'  => $count_member,
                ];
                if (!empty($this->request->getPost('submit_transaksi'))) {
                    $formSubmit = $this->validate([
                        'item_barang'   => 'required',
                        'item_quantity' => 'required|integer',
                    ]);
                    if (!$formSubmit) {
                        return redirect()->to('/transaction-general')->withInput();
                    }
                    // Cek apakah sudah ada item tersebut di database
                    $check = $this->m_sale_detail->where('item_id', $this->request->getPost('item_barang'))->where('sale_id', $find_sale_code->id)->findAll();
                    if (!empty($check)) {
                        session()->setFlashdata('gagal', 'Barang Yang  Dipilih Sudah Ada Dalam List Transaksi');

                        return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                    }
                    $item_barang = $this->m_item->find($this->request->getPost('item_barang'));
                    $stock_sisa  = $item_barang->item_stock - $this->request->getPost('item_quantity');
                    if ($stock_sisa < 0) {
                        session()->setFlashdata('gagal', 'Stok Barang Tidak Mencukupi');

                        return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                    }
                    // Perhitungan Total Belanjar
                    $detail = $this->request->getPost('item_quantity') * $item_barang->item_sale;

                    // Total Keuntungan
                    $profit_per_item = $this->request->getPost('item_quantity') * $item_barang->item_profit;
                    $total_profit    = $find_sale[0]->sale_profit + $profit_per_item;
                    // $total_discount = $find_sale[0]->sale_discount + $item_barang->item_discount;
                    $save_sale_detail = $this->m_sale_detail->save([
                        'detail_total'    => $detail,
                        'detail_quantity' => $this->request->getPost('item_quantity'),
                        'user_id'         => user()->id,
                        'item_id'         => $this->request->getPost('item_barang'),
                        'sale_id'         => $find_sale_code->id,
                    ]);
                    if ($save_sale_detail) {
                        $save_item = $this->m_item->save([
                            'id'         => $item_barang->id,
                            'item_stock' => $stock_sisa,
                        ]);
                        if ($save_item) {

                            // Perhitungan Belanja Baru
                            $get_all   = $this->m_sale_detail->where('sale_id', $find_sale_code->id)->findAll();
                            $sub_tot_1 = 0;

                            foreach ($get_all as $detail) {
                                $sub_tot_1 = $sub_tot_1 + $detail->detail_total;
                            }
                            $discount    = $sub_tot_1 * $find_sale[0]->sale_discount / 100;
                            $sub_tot_2   = $sub_tot_1 - $discount;
                            $sub_tot_3   = $find_sale[0]->sale_handling + $sub_tot_2;
                            $pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
                            $grand_total = $sub_tot_3 + $pph;
                            // End Perhitungan Belanja Baru

                            $save_sale = $this->m_sale->save([
                                'id'          => $find_sale_code->id,
                                'sale_total'  => $grand_total,
                                'sale_profit' => $total_profit,
                            ]);
                            if ($save_sale) {
                                return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                            }
                            session()->setFlashdata('gagal', 'Gagal Mengubah Transaksi Yang Dipilih');

                            return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');

                        return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Menambahkan Detail Transaksi');

                    return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                }
                if (!empty($this->request->getPost('batalkan_transaksi'))) {
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
                            session()->setFlashdata('berhasil', 'Berhasil Membatalkan Transaksi Yang Dipilih');

                            return redirect()->to('/transaction-general/report')->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Gagal Membatalkan Transaksi Yang Dipilih');

                        return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');

                    return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                }
                if (!empty($this->request->getPost('delete_item'))) {

                    // Ambil detail penjualan
                    $detail_sale = $this->m_sale_detail->find($this->request->getPost('id_item'));
                    // Ambil barang berdasarkan id item yang ada didetail penjualan
                    $item_barang = $this->m_item->find($detail_sale->item_id);
                    // Hitung stocknya jika dihapus
                    $stock_sisa = $item_barang->item_stock + $detail_sale->detail_quantity;

                    // Perhitungan Total Belanjar
                    $detail = $detail_sale->detail_quantity * $item_barang->item_sale;

                    // Total Keuntungan
                    $profit_per_item = $detail_sale->detail_quantity * $item_barang->item_profit;
                    $total_profit    = $find_sale[0]->sale_profit - $profit_per_item;

                    // Perlu input itu ada stoknya, sale_total,sale_profit
                    // Pertama ubah stocknya
                    $save_update_stock = $this->m_item->save([
                        'id'         => $detail_sale->item_id,
                        'item_stock' => $stock_sisa,
                    ]);
                    if ($save_update_stock) {
                        if ($this->m_sale_detail->delete($this->request->getPost('id_item'))) {
                            // Perhitungan Belanja Baru
                            $get_all   = $this->m_sale_detail->where('sale_id', $find_sale_code->id)->findAll();
                            $sub_tot_1 = 0;

                            foreach ($get_all as $detail) {
                                $sub_tot_1 = $sub_tot_1 + $detail->detail_total;
                            }
                            $discount    = $sub_tot_1 * $find_sale[0]->sale_discount / 100;
                            $sub_tot_2   = $sub_tot_1 - $discount;
                            $sub_tot_3   = $find_sale[0]->sale_handling + $sub_tot_2;
                            $pph         = $sub_tot_3 * $pph_model[0]->pph_value / 100;
                            $grand_total = $sub_tot_3 + $pph;
                            // End Perhitungan Belanja Baru

                            $save_update_sale = $this->m_sale->save([
                                'id'          => $detail_sale->sale_id,
                                'sale_total'  => $grand_total,
                                'sale_profit' => $total_profit,
                            ]);

                            if ($save_update_sale) {
                                return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                            }
                            session()->setFlashdata('gagal', 'Gagal Memperbaharui Transaksi Yang Dipilih');

                            return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Gagal Menghapus Item Barang Yang Dipilih');

                        return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Gagal Memperbaharui Stok Barang');

                    return redirect()->to('/transaction-general/report/search?sale_code=' . $this->request->getGet('sale_code'))->withCookies();
                }
                if (!empty($this->request->getPost('invoice'))) {
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
                        set_cookie('transaction-general', false, 900);
                        delete_cookie('transaction-general');
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
                    return view('Admin/page/search-general', $data);
                }
            } else {
                return redirect()->to('/transaction-general/report');
            }
        } else {
            return redirect()->to('/transaction-general/report');
        }
    }
}
