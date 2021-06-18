<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemModel;
use App\Models\SupplierModel;

class Supplier extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_supplier = new SupplierModel();
		$this->m_item = new ItemModel();
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
				dd($formSubmit);
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

	public function report()
	{
		return view('Admin/page/supplier_report');
	}

	public function order()
	{
		return view('Admin/page/supplier_order');
	}
}