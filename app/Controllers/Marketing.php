<?php

namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\RequestOrderModel;
use Hermawan\DataTables\DataTable;

class Marketing extends BaseController
{
    public function __construct()
    {
        $this->validate        = \Config\Services::validation();
        $this->m_request_order = new RequestOrderModel();
        $this->m_item          = new ItemModel();
        $this->m_order_detail  = new OrderDetailModel();
        $this->m_order         = new OrderModel();
        $this->crop            = \Config\Services::image();
    }

    public function ajaxDatatables()
    {
        $db   = db_connect();
        $item = $db->table('items')
            ->select('items.id, items.item_image, items.item_code, items.item_name, items.item_merk, items.item_type, items.item_weight, items.item_length, items.item_width, items.item_before_sale, items.item_discount, items.item_sale, items.item_description, items.item_warehouse_a, items.item_warehouse_b, items.item_warehouse_c, items.item_warehouse_d, items.item_stock, items.updated_at, suppliers.supplier_name, item_categories.category_name')
            ->join('item_categories', 'item_categories.id = items.category_id')
            ->join('suppliers', 'suppliers.id = items.supplier_id');

        return DataTable::of($item)
            ->addNumbering('row_number')
            ->toJson(true);
    }

    public function index()
    {
        $data = [
            'items'      => $this->m_item->getAllItem(),
            'validation' => $this->validate,
        ];

        return view('Admin/page/marketing-items', $data);
    }

    public function order()
    {
        $data = [
            'request_order' => $this->m_request_order->getAllOrder(),
            'item'          => $this->m_item->getAllItem(),
            'validation'    => $this->validate,
        ];
        if (! empty($this->request->getPost('input_request_order'))) {
            $formSubmit = $this->validate([
                'item_name'           => 'required',
                'request_description' => 'required',
                'order_total'         => 'required|integer',
            ]);
            if (! $formSubmit) {
                return redirect()->to('/marketing/order-items')->withInput();
            }
            $save = $this->m_request_order->save([
                'request_description' => ucwords($this->request->getPost('request_description')),
                'request_total'       => $this->request->getPost('order_total'),
                'request_status'      => 0,
                'item_id'             => $this->request->getPost('item_name'),
                'user_id'             => user()->id,
            ]);
            if ($save) {
                session()->setFlashdata('berhasil', 'Permintaan Order Barang Berhasil Dibuat');

                return redirect()->to('/marketing/order-items')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Menambahkan Order Barang');

            return redirect()->to('/marketing/order-items')->withCookies();
        } elseif (! empty($this->request->getPost('update_request_order'))) {
            $formSubmit = $this->validate([
                'item_name'           => 'required',
                'request_description' => 'required',
                'order_total'         => 'required|integer',
            ]);
            if (! $formSubmit) {
                return redirect()->to('/marketing/order-items')->withInput();
            }
            $save = $this->m_request_order->save([
                'id'                  => $this->request->getPost('id_order'),
                'request_description' => ucwords($this->request->getPost('request_description')),
                'request_total'       => $this->request->getPost('order_total'),
                'request_status'      => 0,
                'item_id'             => $this->request->getPost('item_name'),
                'user_id'             => user()->id,
            ]);
            if ($save) {
                session()->setFlashdata('berhasil', 'Permintaan Order Barang Berhasil Diperbaharui');

                return redirect()->to('/marketing/order-items')->withCookies();
            }
            session()->setFlashdata('gagal', 'Gagal Memperbaharui Order Barang');

            return redirect()->to('/marketing/order-items')->withCookies();
        } elseif (! empty($this->request->getPost('delete_request_order'))) {
            // Disini ada perkondisian untuk menghitung
            $find = $this->m_request_order->find($this->request->getPost('id_order'));
            if (! empty($find)) {
                if ($this->m_request_order->delete($this->request->getPost('id_order'))) {
                    session()->setFlashdata('berhasil', 'Permintaan Order Barang Yang Dipilih Berhasil Dihapus');

                    return redirect()->to('/marketing/order-items')->withCookies();
                }
                session()->setFlashdata('gagal', 'Permintaan Order Barang Yang Dipilih Gagal Dihapus');

                return redirect()->to('/marketing/order-items')->withCookies();
            }
            session()->setFlashdata('gagal', 'Kode Order Gagal Ditemukan');

            return redirect()->to('/marketing/order-items')->withCookies();
        }

        return view('Admin/page/marketing_order', $data);
    }

    public function view_order()
    {
        $data = [
            'order'      => $this->m_order->getAllOrder(),
            'validation' => $this->validate,
        ];

        return view('Admin/page/marketing_list_order', $data);
    }

    public function list_orders()
    {
        if (! empty($this->request->getGet('order_code'))) {
            $find = $this->m_order->getAllOrder(null, $this->request->getGet('order_code'));
            if (! empty($find)) {
                $data = [
                    'supplier'    => $find,
                    'validation'  => $this->validate,
                    'count_order' => $this->m_order->where('supplier_id', $find[0]->supplier_id)->countAllResults(),
                    'order'       => $this->m_order_detail->getAllOrder($find[0]->id),
                    'item'        => $this->m_item->getAllItem(null, $find[0]->supplier_id),
                ];

                return view('Admin/page/marketing_list_orders', $data);
            }
            session()->setFlashdata('gagal', 'Pesanan Gagal Ditemukan');

            return redirect()->to('/marketing/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
        }

        return redirect()->to('/marketing/order-items')->withCookies();
    }
}
