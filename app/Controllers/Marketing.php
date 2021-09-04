<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\RequestOrderModel;

class Marketing extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_request_order = new RequestOrderModel();
		$this->m_item = new ItemModel();
		$this->m_order_detail = new OrderDetailModel();
		$this->m_order = new OrderModel();
		$this->crop = \Config\Services::image();
	}
	public function index()
	{
		$data = [
			'items' => $this->m_item->getAllItem(),
			'validation' => $this->validate,
		];
		return view('Admin/page/marketing-items', $data);
	}

	public function order()
	{
		$data = [
			'request_order' => $this->m_request_order->getAllOrder(),
			'item' => $this->m_item->getAllItem(),
			'validation' => $this->validate,
		];
		if (!empty($this->request->getPost('input_request_order'))) {
			$formSubmit = $this->validate([
				'item_name' => 'required',
				'request_description' => 'required',
				'order_total' => 'required|integer',
			]);
			if (!$formSubmit) {
				return redirect()->to('/marketing/order-items')->withInput();
			} else {
				$save = $this->m_request_order->save([
					'request_description' => ucWords($this->request->getPost('request_description')),
					'request_total' => $this->request->getPost('order_total'),
					'request_status' => 0,
					'item_id' => $this->request->getPost('item_name'),
					'user_id' => user()->id,
				]);
				if ($save) {
					session()->setFlashdata('berhasil', 'Permintaan Order Barang Berhasil Dibuat');
					return redirect()->to('/marketing/order-items')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Gagal Menambahkan Order Barang');
					return redirect()->to('/marketing/order-items')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('update_request_order'))) {
			$formSubmit = $this->validate([
				'item_name' => 'required',
				'request_description' => 'required',
				'order_total' => 'required|integer',
			]);
			if (!$formSubmit) {
				return redirect()->to('/marketing/order-items')->withInput();
			} else {
				$save = $this->m_request_order->save([
					'id' => $this->request->getPost('id_order'),
					'request_description' => ucWords($this->request->getPost('request_description')),
					'request_total' => $this->request->getPost('order_total'),
					'request_status' => 0,
					'item_id' => $this->request->getPost('item_name'),
					'user_id' => user()->id,
				]);
				if ($save) {
					session()->setFlashdata('berhasil', 'Permintaan Order Barang Berhasil Diperbaharui');
					return redirect()->to('/marketing/order-items')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Gagal Memperbaharui Order Barang');
					return redirect()->to('/marketing/order-items')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('delete_request_order'))) {
			// Disini ada perkondisian untuk menghitung 
			$find = $this->m_request_order->find($this->request->getPost('id_order'));
			if (!empty($find)) {
				if ($this->m_request_order->delete($this->request->getPost('id_order'))) {
					session()->setFlashdata('berhasil', 'Permintaan Order Barang Yang Dipilih Berhasil Dihapus');
					return redirect()->to('/marketing/order-items')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Permintaan Order Barang Yang Dipilih Gagal Dihapus');
					return redirect()->to('/marketing/order-items')->withCookies();
				}
			} else {
				session()->setFlashdata('gagal', 'Kode Order Gagal Ditemukan');
				return redirect()->to('/marketing/order-items')->withCookies();
			}
		} else {
			return view('Admin/page/marketing_order', $data);
		}
	}

	public function view_order()
	{
		$data = [
			'order' => $this->m_order->getAllOrder(),
			'validation' => $this->validate,
		];
		return view('Admin/page/marketing_list_order', $data);
	}

	public function list_orders()
	{
		if (!empty($this->request->getGet('order_code'))) {
			$find = $this->m_order->getAllOrder(null, $this->request->getGet('order_code'));
			if (!empty($find)) {
				$data = [
					'supplier' => $find,
					'validation' => $this->validate,
					'count_order' => $this->m_order->where('supplier_id', $find[0]->supplier_id)->countAllResults(),
					'order' => $this->m_order_detail->getAllOrder($find[0]->id),
					'item' => $this->m_item->getAllItem(null, $find[0]->supplier_id),
				];
				return view('Admin/page/marketing_list_orders', $data);
			} else {
				session()->setFlashdata('gagal', 'Pesanan Gagal Ditemukan');
				return redirect()->to('/marketing/create_orders?order_code=' . $this->request->getGet('order_code'))->withCookies();
			}
		} else {
			return redirect()->to('/marketing/order-items')->withCookies();
		}
	}
}
