<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemCategoryModel;
use App\Models\ItemModel;
use App\Models\SupplierModel;

class Category extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_category = new ItemCategoryModel();
		$this->m_item = new ItemModel();
	}

	
	public function index()
	{
		$data = [
			'validation' => $this->validate,
			'category' => $this->m_category->findAll(),
		];
		if (!empty($this->request->getPost('submit_category'))) {
			$formSubmit = $this->validate([
				'category' => 'required|max_length[200]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/categories')->withInput();
			} else {
				$save = $this->m_category->save([
					'category_name' => ucWords($this->request->getPost('category')),
				]);
				if ($save) {
					session()->setFlashdata('berhasil', 'Kategori Baru Berhasil Ditambahkan');
					return redirect()->to('/categories')->withCookies();
				} else {
					session()->setFlashdata('berhasil', 'Gagal Menambahkan Kategori');
					return redirect()->to('/categories')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('update_category'))) {
			$formSubmit = $this->validate([
				'category_update' => 'required|max_length[200]',
			]);
			if (!$formSubmit) {
				return redirect()->to('/categories')->withInput();
			} else {
				$save = $this->m_category->save([
					'id' => $this->request->getPost('id_category'),
					'category_name' => ucWords($this->request->getPost('category_update')),
				]);
				if ($save) {
					session()->setFlashdata('berhasil', 'Data Kategori Yang Dipilih Berhasil Diubah');
					return redirect()->to('/categories')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Gagal Mengubah Data Kategori');
					return redirect()->to('/categories')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('delete_category'))) {
			$find = $this->m_category->find($this->request->getPost('id_category'));
			if (!empty($find)) {
				$find_relation = $this->m_item->where('category_id', $find->id)->findAll();
				if (!empty($find_relation)) {
					foreach ($find_relation as $r) {
						unlink('upload/produk/' . $r->item_image);
					}
					$status = true;
				} else {
					$status = true;
				}
				if ($status) {
					if ($this->m_category->delete($this->request->getPost('id_category'))) {
						session()->setFlashdata('berhasil', 'Data Kategori Yang Dipilih Berhasil Dihapus');
						return redirect()->to('/categories')->withCookies();
					} else {
						session()->setFlashdata('gagal', 'Gagal Menghapus Data Kategori');
						return redirect()->to('/categories')->withCookies();
					}
				}
			}
		} else {
			return view('Admin/page/categories', $data);
		}
	}
}