<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\RequestOrderModel;
use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function __construct()
    {
        $this->validate        = \Config\Services::validation();
        $this->m_supplier      = new SupplierModel();
        $this->m_item          = new ItemModel();
        $this->m_request_order = new RequestOrderModel();
        $this->m_order         = new OrderModel();
        $this->m_order_detail  = new OrderDetailModel();
    }

    public function index()
    {
        if (in_groups('SUPER ADMIN') || in_groups('PURCHASING')) {
            $data = [
                'supplier'   => $this->m_supplier->findAll(),
                'validation' => $this->validate,
            ];
            if (!empty($this->request->getPost('input_supplier'))) {
                $formSubmit = $this->validate([
                    'supplier_name'        => 'required|max_length[200]',
                    'supplier_contact'     => 'required|is_natural',
                    'supplier_email'       => 'required|valid_email',
                    'supplier_alamat'      => 'required',
                    'supplier_description' => 'required|max_length[500]',
                ]);
                if (!$formSubmit) {
                    return redirect()->to('/suppliers')->withInput();
                }
                $save = $this->m_supplier->save([
                    'supplier_name'        => ucwords($this->request->getPost('supplier_name')),
                    'supplier_contact'     => $this->request->getPost('supplier_contact'),
                    'supplier_email'       => $this->request->getPost('supplier_email'),
                    'supplier_address'     => ucwords($this->request->getPost('supplier_alamat')),
                    'supplier_description' => ucwords($this->request->getPost('supplier_description')),
                ]);
                if ($save) {
                    session()->setFlashdata('berhasil', 'Supplier Baru Berhasil Ditambahkan');

                    return redirect()->to('/suppliers')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Menambahkan Supplier');

                return redirect()->to('/suppliers')->withCookies();
            }
            if (!empty($this->request->getPost('update_supplier'))) {
                $formSubmit = $this->validate([
                    'supplier_name_up'        => 'required|max_length[200]',
                    'supplier_contact_up'     => 'required|is_natural',
                    'supplier_email_up'       => 'required|valid_email',
                    'supplier_alamat_up'      => 'required',
                    'supplier_description_up' => 'required|max_length[500]',
                ]);
                if (!$formSubmit) {
                    return redirect()->to('/suppliers')->withInput();
                }
                $save = $this->m_supplier->save([
                    'id'                   => $this->request->getPost('id_supplier'),
                    'supplier_name'        => ucwords($this->request->getPost('supplier_name_up')),
                    'supplier_contact'     => $this->request->getPost('supplier_contact_up'),
                    'supplier_email'       => $this->request->getPost('supplier_email_up'),
                    'supplier_address'     => ucwords($this->request->getPost('supplier_alamat_up')),
                    'supplier_description' => ucwords($this->request->getPost('supplier_description_up')),
                ]);
                if ($save) {
                    session()->setFlashdata('berhasil', 'Supplier Yang Dipilih Berhasil Diubah');

                    return redirect()->to('/suppliers')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Mengubah Supplier');

                return redirect()->to('/suppliers')->withCookies();
            }
            if (!empty($this->request->getPost('delete_supplier'))) {
                $find          = $this->m_supplier->find($this->request->getPost('id_supplier'));
                $find_relation = $this->m_item->where('supplier_id', $find->id)->findAll();

                if (!empty($find)) {
                    if (!empty($find_relation)) {
                        foreach ($find_relation as $r) {
                            unlink('upload/produk/' . $r->item_image);
                        }
                        $status = true;
                    } else {
                        $status = true;
                    }
                    if ($status) {
                        if ($this->m_supplier->delete($this->request->getPost('id_supplier'))) {
                            session()->setFlashdata('berhasil', 'Supplier Yang Dipilih Berhasil Dihapus');

                            return redirect()->to('/suppliers')->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Gagal Menghapus Supplier');

                        return redirect()->to('/suppliers')->withCookies();
                    }
                } else {
                    session()->setFlashdata('gagal', 'Gagal Menemukan Data Supplier');

                    return redirect()->to('/suppliers')->withCookies();
                }
            } else {
                return view('Admin/page/suppliers', $data);
            }
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
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

    public function order()
    {
        $bulan        = $this->_month(date('m'));
        $tahun        = date('Y');
        $last_id      = $this->m_order->orderBy('id', 'DESC')->first() == null ? 1 : $this->m_order->orderBy('id', 'DESC')->first()->id + 1;
        $leading_kode = sprintf('%03d', $last_id);
        $kode_po      = "{$leading_kode}/DIN/{$bulan}/{$tahun}";
        $data         = [
            'order'      => $this->m_order->getAllOrder(),
            'validation' => $this->validate,
            'supplier'   => $this->m_supplier->findAll(),
            'kode_po'    => $kode_po,
        ];
        if (!empty($this->request->getPost('input_order'))) {
            $formSubmit = $this->validate([
                'supplier_name' => 'required',
            ]);
            if (!$formSubmit) {
                return redirect()->to('/suppliers/order-items')->withInput();
            }
            $this->m_order->save([
                'order_code'           => 'Token',
                'order_total_quantity' => '0',
                'order_total_item'     => '0',
                'order_status'         => '1',
                'user_id'              => user()->id,
                'supplier_id'          => $this->request->getPost('supplier_name'),
            ]);
            $save_data         = $this->m_order->save([
                'id'         => $last_id,
                'order_code' => $kode_po,
            ]);
            if ($save_data) {
                session()->setFlashdata('berhasil', 'Permintaan Order Barang Berhasil Dibuat');
                return redirect()->to('/suppliers/order-items')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Menambahkan Order Barang');

            return redirect()->to('/suppliers/order-items')->withCookies();
        }
        if (!empty($this->request->getPost('update_status_order'))) {
            // Disini ada perkondisian untuk menghitung
            $formSubmit = $this->validate([
                'order_name_up' => 'required',
            ]);
            if (!$formSubmit) {
                return redirect()->to('/suppliers/order-items')->withInput();
            }
            if ($this->request->getPost('order_name_up') == 8) {
                $order_data = $this->m_order_detail->where('order_id', $this->request->getPost('id_order'))->findAll();

                $status_order_data = true;
                foreach ($order_data as $o) {
                    if ($o->status_order == 1) {
                        $status_order_data = false;
                    }
                }

                if ($status_order_data != true) {
                    session()->setFlashdata('gagal', 'Belum Semua Barang Diterima, Tidak Dapat Diselesaikan');
                    return redirect()->to('/suppliers/order-items')->withCookies();
                }
            }

            if ($this->request->getPost('order_name_up') == 6) {
                $order_data = $this->m_order_detail->where('order_id', $this->request->getPost('id_order'))->findAll();

                foreach ($order_data as $o) {
                    $save = $this->m_order_detail->save([
                        'id' => $o->id,
                        'status_order'    => 1,
                    ]);
                }
            }
            $save = $this->m_order->save([
                'id'           => $this->request->getPost('id_order'),
                'order_status' => $this->request->getPost('order_name_up'),
            ]);
            if ($save) {
                session()->setFlashdata('berhasil', 'Status Order Berhasil Diperbaharui');

                return redirect()->to('/suppliers/order-items')->withCookies();
            }
            session()->setFlashdata('gagal', 'Status Order Gagal Diperbaharui');

            return redirect()->to('/suppliers/order-items')->withCookies();
        }
        if (!empty($this->request->getPost('delete_order'))) {
            // Disini ada perkondisian untuk menghitung
            $find = $this->m_order->find($this->request->getPost('id_order'));
            if (!empty($find)) {
                if ($this->m_order->delete($this->request->getPost('id_order'))) {
                    session()->setFlashdata('berhasil', 'Permintaan Order Barang Yang Dipilih Berhasil Dihapus');

                    return redirect()->to('/suppliers/order-items')->withCookies();
                }
                session()->setFlashdata('gagal', 'Permintaan Order Barang Yang Dipilih Gagal Dihapus');

                return redirect()->to('/suppliers/order-items')->withCookies();
            }
            session()->setFlashdata('gagal', 'Kode Order Gagal Ditemukan');

            return redirect()->to('/suppliers/order-items')->withCookies();
        }

        return view('Admin/page/supplier_order', $data);
    }

    public function create_order()
    {
        if (!empty($this->request->getGet('order_code'))) {
            $find = $this->m_order->getAllOrder(null, $this->request->getGet('order_code'));
            if (!empty($find)) {
                $data = [
                    'supplier'    => $find,
                    'validation'  => $this->validate,
                    'count_order' => $this->m_order->where('supplier_id', $find[0]->supplier_id)->countAllResults(),
                    'order'       => $this->m_order_detail->getAllOrder($find[0]->id),
                    'item'        => $this->m_item->getAllItem(null, $find[0]->supplier_id),
                ];
                if ($this->request->getPost('input_order')) {
                    $formSubmit = $this->validate([
                        'item_name'     => 'required',
                        'item_quantity' => 'required|integer',
                    ]);
                    if (!$formSubmit) {
                        return redirect()->to('/suppliers/order-items')->withInput();
                    }
                    $check_item = $this->m_order_detail->where('item_id', $this->request->getPost('item_name'))->where('order_id', $this->request->getPost('id_order'))->findAll();
                    if (empty($check_item)) {
                        $save = $this->m_order_detail->save([
                            'detail_quantity' => $this->request->getPost('item_quantity'),
                            'progress_total'  => $this->request->getPost('item_quantity'),
                            'receiving_total' => 0,
                            'status_order'    => 0,
                            'user_id'         => user()->id,
                            'order_id'        => $this->request->getPost('id_order'),
                            'item_id'         => $this->request->getPost('item_name'),
                        ]);
                        if ($save) {
                            $count      = $this->m_order_detail->getAllOrder($find[0]->id);
                            $i          = 0;
                            $total_item = 0;

                            foreach ($count as $c) {
                                $i++;
                                $total_item = $total_item + $c->detail_quantity;
                            }
                            $save_count = $this->m_order->save([
                                'id'                   => $find[0]->id,
                                'order_total_quantity' => $i,
                                'order_total_item'     => $total_item,
                            ]);
                            if ($save_count) {
                                session()->setFlashdata('berhasil', 'Pesanan Baru Berhasil Dibuat');

                                return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                            }
                            session()->setFlashdata('gagal', 'Pesanan Gagal Dibuat');

                            return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Pesanan Gagal Dibuat');

                        return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Pesanan Gagal Dibuat, Produk Yang Dipilih Sudah Ada Di List Pesanan');

                    return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                }
                if ($this->request->getPost('update_order')) {
                    $formSubmit = $this->validate([
                        'item_name_up'     => 'required',
                        'item_quantity_up' => 'required|integer',
                    ]);
                    if (!$formSubmit) {
                        return redirect()->to('/suppliers/order-items')->withInput();
                    }
                    $find_order = $this->m_order_detail->find($this->request->getPost('id_order_detail'));
                    // dd($find->item_id == $this->request->getPost('item_name_up'));
                    if ($find_order->item_id == $this->request->getPost('item_name_up')) {
                        $status = true;
                    } else {
                        $check_item = $this->m_order_detail->where('item_id', $this->request->getPost('item_name_up'))->where('order_id', $this->request->getPost('id_order'))->findAll();
                        if (empty($check_item)) {
                            $status = true;
                        } else {
                            $status = false;
                        }
                    }
                    if ($status) {
                        $save = $this->m_order_detail->save([
                            'id'              => $this->request->getPost('id_order_detail'),
                            'detail_quantity' => $this->request->getPost('item_quantity_up'),
                            'progress_total'  => $this->request->getPost('item_quantity_up'),
                            'status_order'    => 0,
                            'receiving_total' => 0,
                            'user_id'         => user()->id,
                            'order_id'        => $this->request->getPost('id_order'),
                            'item_id'         => $this->request->getPost('item_name_up'),
                        ]);
                        if ($save) {
                            $count      = $this->m_order_detail->getAllOrder($find[0]->id);
                            $i          = 0;
                            $total_item = 0;

                            foreach ($count as $c) {
                                $i++;
                                $total_item = $total_item + $c->detail_quantity;
                            }
                            $save_count = $this->m_order->save([
                                'id'                   => $find[0]->id,
                                'order_total_quantity' => $i,
                                'order_total_item'     => $total_item,
                            ]);
                            if ($save_count) {
                                session()->setFlashdata('berhasil', 'Pesanan Yang Dipilih Berhasil Diperbaharui');

                                return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                            }
                            session()->setFlashdata('gagal', 'Pesanan Yang Dipilih Gagal Diperbaharui');

                            return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Pesanan Yang Dipilih Gagal Diperbaharui');

                        return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Pesanan Gagal Dibuat, Produk Yang Dipilih Sudah Ada Di List Pesanan');

                    return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                }
                if ($this->request->getPost('delete_order')) {
                    $find_order = $this->m_order_detail->find($this->request->getPost('id_order'));
                    if (!empty($find_order)) {
                        if ($this->m_order_detail->delete($this->request->getPost('id_order'))) {
                            $count      = $this->m_order_detail->getAllOrder($find[0]->id);
                            $i          = 0;
                            $total_item = 0;

                            foreach ($count as $c) {
                                $i++;
                                $total_item = $total_item + $c->detail_quantity;
                            }
                            $save_count = $this->m_order->save([
                                'id'                   => $find[0]->id,
                                'order_total_quantity' => $i,
                                'order_total_item'     => $total_item,
                            ]);
                            if ($save_count) {
                                session()->setFlashdata('berhasil', 'Pesanan Yang Dipilih Berhasil Dihapus');

                                return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                            }
                            session()->setFlashdata('gagal', 'Pesanan Yang Dipilih Gagal Dihapus');

                            return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                        }
                        session()->setFlashdata('gagal', 'Pesanan Yang Dipilih Gagal Dihapus');

                        return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                    }
                    session()->setFlashdata('gagal', 'Data Pesanan Gagal Ditemukan');

                    return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
                }
                if ($this->request->getPost('input_order_po')) {
                    $noted = $this->request->getPost('order_po');
                    $update_data = $this->m_order->save([
                        'id' => $find[0]->id,
                        'order_po' => $noted,
                    ]);
                    if ($update_data) {
                        //Cetak PO Ada Disini
                        dd('cetak po');
                    }
                    session()->setFlashdata('gagal', 'Gagal Menambahkan Noted');
                }
                if ($this->request->getPost('input_rogs')) {
                    // Cetak ROGS Disini
                    dd('cetak rogs');
                }
                return view('Admin/page/create_orders', $data);
            }
            session()->setFlashdata('gagal', 'Pesanan Gagal Ditemukan');

            return redirect()->to('/suppliers/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
        }

        return redirect()->to('/suppliers/order-items')->withCookies();
    }

    public function export_pdf()
    {
        $find          = $this->m_order->find($this->request->getPost('id_order'));
        $find_order    = $this->m_order_detail->getAllOrder($find->id);
        $find_supplier = $this->m_supplier->find($find->supplier_id);
        $data          = [
            'order'    => $find,
            'detail'   => $find_order,
            'supplier' => $find_supplier,
        ];
        $mpdf = new \Mpdf\Mpdf();
        $html = view('Admin/page/invoice_order', $data);
        $mpdf->WriteHTML($html);
        $mpdf->showImageErrors = true;
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Invoice Order.pdf', 'I');
        // return view('');
    }

    public function view_order()
    {
        if (in_groups('SUPER ADMIN') || in_groups('PURCHASING')) {
            $data = [
                'request_order' => $this->m_request_order->getAllOrder(),
                'item'          => $this->m_item->getAllItem(),
                'validation'    => $this->validate,
            ];
            if (!empty($this->request->getPost('update_status_order'))) {
                $formSubmit = $this->validate([
                    'request_status' => 'required|integer',
                    'alasan'         => 'required|max_length[255]',
                ]);
                if (!$formSubmit) {
                    return redirect()->to('/suppliers/view-orders')->withInput();
                }
                $save = $this->m_request_order->save([
                    'id'             => $this->request->getPost('id_order'),
                    'request_status' => $this->request->getPost('request_status'),
                    'alasan'         => $this->request->getPost('alasan'),
                ]);
                if ($save) {
                    session()->setFlashdata('berhasil', 'Status Permintaan Order Barang Berhasil Diperbaharui');

                    return redirect()->to('/suppliers/view-orders')->withCookies();
                }
                session()->setFlashdata('gagal', 'Gagal Memperbaharui Status Order Barang');

                return redirect()->to('/suppliers/view-orders')->withCookies();
            }

            return view('Admin/page/list_request_order', $data);
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    public function receiving()
    {
        $bulan        = $this->_month(date('m'));
        $tahun        = date('Y');
        $last_id      = $this->m_order->orderBy('id', 'DESC')->first() == null ? 1 : $this->m_order->orderBy('id', 'DESC')->first()->id + 1;
        $leading_kode = sprintf('%03d', $last_id);
        $kode_po      = "{$leading_kode}/DIN/{$bulan}/{$tahun}";
        $data         = [
            'order'      => $this->m_order->getAllOrder(),
            'validation' => $this->validate,
            'supplier'   => $this->m_supplier->findAll(),
            'kode_po'    => $kode_po,
        ];
        return view('Admin/page/receiving/index', $data);
    }

    public function receiving_detail()
    {
        if (!empty($this->request->getGet('order_code'))) {
            $find = $this->m_order->getAllOrder(null, $this->request->getGet('order_code'));
            if (!empty($find)) {
                $data = [
                    'supplier'    => $find,
                    'validation'  => $this->validate,
                    'count_order' => $this->m_order->where('supplier_id', $find[0]->supplier_id)->countAllResults(),
                    'order'       => $this->m_order_detail->getAllOrder($find[0]->id),
                    'item'        => $this->m_item->getAllItem(null, $find[0]->supplier_id),
                ];

                if ($this->request->getPost('update_receiving')) {
                    $total_receiving = $this->request->getPost('receiving_total');
                    $order_detail = $this->m_order_detail->getAllOrderWhere($this->request->getPost('id_order_detail'));
                    if ($total_receiving <= $order_detail[0]->detail_quantity) {
                        $find_item   = $this->m_item->getAllItem($order_detail[0]->item_id);

                        // Kurangi dlu dengan data di database
                        $total       = $find_item[0]->item_stock - $order_detail[0]->receiving_total;
                        $warehouse_a = $find_item[0]->item_warehouse_a - $order_detail[0]->receiving_total;

                        // Tambahkan dengan data  dari receiving total
                        $total_baru       = $total < 0 ? 0 + $total_receiving : $total + $total_receiving;
                        $warehouse_a_baru = $warehouse_a < 0 ? 0 + $total_receiving : $warehouse_a + $total_receiving;

                        // Simpan Data
                        $save_item = $this->m_item->save([
                            'id'               => $find_item[0]->id,
                            'item_warehouse_a' => $warehouse_a_baru,
                            'item_stock'       => $total_baru,
                        ]);


                        $save = $this->m_order_detail->save([
                            'id' => $order_detail[0]->id,
                            'receiving_total' => $total_receiving,
                            'progress_total' => $order_detail[0]->detail_quantity - $total_receiving,
                            'status_order' => $total_receiving == $order_detail[0]->detail_quantity ? 2 : 1,
                            'receiving_remark' => $this->request->getPost('receiving_remark'),
                        ]);
                        if ($save && $save_item) {
                            session()->setFlashdata('berhasil', 'Jumlah Barang Receiving Berhasil Diperbaharui');
                            return redirect()->to('/suppliers/receiving-detail?order_code=' . $this->request->getGet('order_code'))->withCookies();
                        }
                    } else {
                        session()->setFlashdata('gagal', 'Total Receiving Tidak Dapat Lebih Dari Total Order');
                        return redirect()->to('/suppliers/receiving-detail?order_code=' . $this->request->getGet('order_code'))->withCookies();
                    }
                }
                return view('Admin/page/receiving/detail', $data);
            }
            session()->setFlashdata('gagal', 'Pesanan Gagal Ditemukan');
            return redirect()->to('/suppliers/receiving-detail?order_code=' . $this->request->getGet('order_code'))->withCookies();
        }
        return redirect()->to('/suppliers/receiving')->withCookies();
    }
}
