<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\SupplierModel;

class Supplier extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_supplier = new SupplierModel();
		$this->m_item = new ItemModel();
		$this->m_order = new OrderModel();
		$this->m_order_detail = new OrderDetailModel();
	}
	public function index()
	{
		$data = [
			'supplier' => $this->m_supplier->findAll(),
			'validation' => $this->validate,
		];
		if (!empty($this->request->getPost('input_supplier'))) {
			$formSubmit = $this->validate([
				'supplier_name' => 'required|max_length[200]',
				'supplier_contact' => 'required|is_natural',
				'supplier_description' => 'required|max_length[500]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/suppliers')->withInput();
			} else {
				$save = $this->m_supplier->save([
					'supplier_name' => ucWords($this->request->getPost('supplier_name')),
					'supplier_contact' => $this->request->getPost('supplier_contact'),
					'supplier_description' => ucWords($this->request->getPost('supplier_description')),
				]);
				if ($save) {
					echo "Berhasil Ditambahkan";
				} else {
					echo "Gagal Ditambahkan";
				}
			}
		} else if (!empty($this->request->getPost('update_supplier'))) {
			$formSubmit = $this->validate([
				'supplier_name_up' => 'required|max_length[200]',
				'supplier_contact_up' => 'required|is_natural',
				'supplier_description_up' => 'required|max_length[500]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/suppliers')->withInput();
			} else {
				$save = $this->m_supplier->save([
					'id' => $this->request->getPost('id_supplier'),
					'supplier_name' => ucWords($this->request->getPost('supplier_name_up')),
					'supplier_contact' => $this->request->getPost('supplier_contact_up'),
					'supplier_description' => ucWords($this->request->getPost('supplier_description_up')),
				]);
				if ($save) {
					echo "Berhasil Diubah";
				} else {
					echo "Gagal Diubah";
				}
			}
		} else if (!empty($this->request->getPost('delete_supplier'))) {
			$find = $this->m_supplier->find($this->request->getPost('id_supplier'));
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
						echo "Berhasil Dihapus";
					} else {
						echo "Gagal Dihapus";
					}
				}
			} else {
				echo "Data Tidak Ditemukan";
			}
		} else {
			return view('Admin/page/suppliers', $data);
		}
	}

	public function order()
	{
		$data = [
			'order' => $this->m_order->getAllOrder(),
			'validation' => $this->validate,
			'supplier' => $this->m_supplier->findAll(),
		];
		if (!empty($this->request->getPost('input_order'))) {
			$formSubmit = $this->validate([
				'supplier_name' => 'required',
			]);
			if (!$formSubmit) {
				return redirect()->to('/suppliers/order-items')->withInput();
			} else {
				$string = "0123456789BCDFGHJKLMNPQRSTVWXYZ";
				$token = substr(str_shuffle($string), 0, 10);
				$save = $this->m_order->save([
					'order_code' => $token,
					'order_total_quantity' => '0',
					'order_total_item' => '0',
					'order_status' => '1',
					'user_id' => user()->id,
					'supplier_id' => $this->request->getPost('supplier_name'),
				]);
				if ($save) {
					echo "Berhasil Ditambahkan";
				} else {
					echo "Gagal Ditambahkan";
				}
			}
		} else if (!empty($this->request->getPost('update_status_order'))) {
			// Disini ada perkondisian untuk menghitung 
			$formSubmit = $this->validate([
				'order_name_up' => 'required',
			]);
			if (!$formSubmit) {
				return redirect()->to('/suppliers/order-items')->withInput();
			} else {
				$save = $this->m_order->save([
					'id' => $this->request->getPost('id_order'),
					'order_status' => $this->request->getPost('order_name_up'),
				]);
				if ($save) {
					echo "Berhasil Diset Ulang";
				} else {
					echo "Gagal Diset Ulang";
				}
			}
		} else if (!empty($this->request->getPost('delete_order'))) {
			// Disini ada perkondisian untuk menghitung 
			$find = $this->m_order->find($this->request->getPost('id_order'));
			if (!empty($find)) {
				if ($this->m_order->delete($this->request->getPost('id_order'))) {
					echo "Berhasil dihapus";
				} else {
					echo "Gagal Dihapus";
				}
			} else {
				echo "Data Tidak Ditemukan";
			}
		} else {
			return view('Admin/page/supplier_order', $data);
		}
	}

	public function create_order()
	{
		if (!empty($this->request->getGet('order_code'))) {
			$find = $this->m_order->getAllOrder(null, $this->request->getGet('order_code'));
			if (!empty($find)) {
				$data = [
					'supplier' => $find,
					'validation' => $this->validate,
					'order' => $this->m_order_detail->getAllOrder($find[0]->id),
					'item' => $this->m_item->getAllItem(null, $find[0]->supplier_id),
				];
				if ($this->request->getPost('input_order')) {
					$formSubmit = $this->validate([
						'item_name' => 'required',
						'item_quantity' => 'required|integer',
					]);
					if (!$formSubmit) {
						return redirect()->to('/suppliers/order-items')->withInput();
					} else {
						$check_item = $this->m_order_detail->where('item_id', $this->request->getPost('item_name'))->where('order_id', $this->request->getPost('id_order'))->findAll();
						if (empty($check_item)) {
							$save = $this->m_order_detail->save([
								'detail_quantity' => $this->request->getPost('item_quantity'),
								'user_id' => user()->id,
								'order_id' => $this->request->getPost('id_order'),
								'item_id' => $this->request->getPost('item_name'),
							]);
							if ($save) {
								$count = $this->m_order_detail->getAllOrder($find[0]->id);
								$i = 0;
								$total_item = 0;
								foreach($count as $c){
									$i++;
									$total_item = $total_item + $c->detail_quantity;
								}
								$save_count = $this->m_order->save([
									'id' => $find[0]->id,
									'order_total_quantity' => $i,
									'order_total_item' => $total_item,
								]);
								if($save_count){
									echo "Berhasil Ditambahkan";
								}else{
									echo "Gagal Ditambahkan";
								}
							} else {
								echo "Gagal Ditambahkan";
							}
						} else {
							echo "Gagal Menambahkan Pesanan, Produk sudah ada di list pesanan";
						}
					}
				}else if ($this->request->getPost('update_order')) {
					$formSubmit = $this->validate([
						'item_name_up' => 'required',
						'item_quantity_up' => 'required|integer',
					]);
					if (!$formSubmit) {
						return redirect()->to('/suppliers/order-items')->withInput();
					} else {
						$find_order = $this->m_order_detail->find($this->request->getPost('id_order_detail'));
						// dd($find->item_id == $this->request->getPost('item_name_up'));
						if($find_order->item_id == $this->request->getPost('item_name_up')){
							$status = true;
						}else{
							$check_item = $this->m_order_detail->where('item_id', $this->request->getPost('item_name_up'))->where('order_id', $this->request->getPost('id_order'))->findAll();
							if(empty($check_item)){
								$status = true;
							}else{
								$status = false;
							}
						}
						if ($status) {
							$save = $this->m_order_detail->save([
								'id' => $this->request->getPost('id_order_detail'),
								'detail_quantity' => $this->request->getPost('item_quantity_up'),
								'user_id' => user()->id,
								'order_id' => $this->request->getPost('id_order'),
								'item_id' => $this->request->getPost('item_name_up'),
							]);
							if ($save) {
								$count = $this->m_order_detail->getAllOrder($find[0]->id);
								$i = 0;
								$total_item = 0;
								foreach ($count as $c) {
									$i++;
									$total_item = $total_item + $c->detail_quantity;
								}
								$save_count = $this->m_order->save([
									'id' => $find[0]->id,
									'order_total_quantity' => $i,
									'order_total_item' => $total_item,
								]);
								if ($save_count) {
									echo "Berhasil Diubah";
								} else {
									echo "Gagal Diubah";
								}
							} else {
								echo "Gagal Diubah";
							}
						} else {
							echo "Gagal Mengubah Pesanan, Produk sudah ada di list pesanan";
						}
					}
				} else if ($this->request->getPost('delete_order')) {
					$find_order = $this->m_order_detail->find($this->request->getPost('id_order'));
					if(!empty($find_order)){
						if($this->m_order_detail->delete($this->request->getPost('id_order'))){
							$count = $this->m_order_detail->getAllOrder($find[0]->id);
							$i = 0;
							$total_item = 0;
							foreach ($count as $c) {
								$i++;
								$total_item = $total_item + $c->detail_quantity;
							}
							$save_count = $this->m_order->save([
								'id' => $find[0]->id,
								'order_total_quantity' => $i,
								'order_total_item' => $total_item,
							]);
							if ($save_count) {
								echo "Berhasil Dihapus";
							} else {
								echo "Gagal Dihapus";
							}
						}else{
							echo "Gagal Dihapus";
						}
					}else{
						echo "Data Tidak Ditemukan";
					}
				} else {
					return view('Admin/page/create_orders', $data);
				}
			} else {
				echo "Data Order Tidak Ditemukan";
			}
		} else {
			return redirect()->to('/suppliers/order-items');
		}
	}

	public function export_pdf(){

		$find = $this->m_order->find($this->request->getPost('id_order'));
		$find_order = $this->m_order_detail->getAllOrder($find->id);
		$find_supplier = $this->m_supplier->find($find->supplier_id);
		$data = [
			'order' => $find,
			'detail' => $find_order,
			'supplier' => $find_supplier,
		];
		$mpdf = new \Mpdf\Mpdf();
		$html = view('Admin/page/invoice', $data);
		$mpdf->WriteHTML($html);
		$mpdf->showImageErrors = true;
		$this->response->setHeader('Content-Type', 'application/pdf');
		$mpdf->Output('Invoice Order.pdf', 'I'); 
		// return view('');
	}
}
