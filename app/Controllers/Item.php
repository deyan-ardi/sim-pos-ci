<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemCategoryModel;
use App\Models\ItemModel;
use App\Models\SupplierModel;

class Item extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_item = new ItemModel();
		$this->m_category = new ItemCategoryModel();
		$this->m_supplier = new SupplierModel();
		$this->crop = \Config\Services::image();
	}
	public function index()
	{
		$data = [
			'items' => $this->m_item->getAllItem(),
			'category' => $this->m_category->findAll(),
			'supplier' => $this->m_supplier->findAll(),
			'validation' => $this->validate,
		];
		if (!empty($this->request->getPost('input_items'))) {
			$formSubmit = $this->validate([
				'item_image' =>	'uploaded[item_image]|max_size[item_image,1048]|mime_in[item_image,image/png,image/jpg,image/jpeg]|ext_in[item_image,jpg,jpeg,png]',
				'item_code' => 'required|max_length[25]',
				'item_name' => 'required|max_length[200]',
				'item_merk' => 'permit_empty|max_length[200]',
				'item_type' => 'permit_empty|max_length[200]',
				'item_weight' => 'permit_empty',
				'item_length' => 'permit_empty',
				'item_width' => 'permit_empty',
				'item_height' => 'permit_empty',
				'item_discount' => 'permit_empty',
				'item_hpp' => 'required|integer',
				'item_stock' => 'required|integer',
				'item_sale' => 'required',
				'item_description' => 'permit_empty|max_length[500]',
				'category' => 'required|integer',
				'supplier' => 'required|integer',
			]);
			if (!$formSubmit) {
				return redirect()->to('/items')->withInput();
			} else {
				$fotoProduk = $this->request->getFile('item_image');
				$namaProduk = $fotoProduk->getRandomName();

				$fotoProduk->move('upload/produk', $namaProduk);
				$move = $this->crop
					->withFile('upload/produk/' . $namaProduk)
					->fit(200, 200, 'center')
					->save('upload/produk/' . $namaProduk);
				if ($move) {
					// Perhitungan discount
					$before = $this->request->getPost('item_sale');
					if(empty($this->request->getPost('item_discount'))){
						$bil_dis = 0;
					}else{
						$bil_dis = $this->request->getPost('item_discount');
					}
					$discount = ($before * $bil_dis) / 100;
					$after = $before - $discount;
					$profit = $after - $this->request->getPost('item_hpp');
					if ($profit <= 0) {
						$profit = 0;
					}
					$save = $this->m_item->save([
						'item_image' => $namaProduk,
						'item_code' => $this->request->getPost('item_code'),
						'item_name' => ucWords($this->request->getPost('item_name')),
						'item_merk' => ucWords($this->request->getPost('item_merk')),
						'item_type' =>  ucWords($this->request->getPost('item_type')),
						'item_weight' => $this->request->getPost('item_weight'),
						'item_length' => $this->request->getPost('item_length'),
						'item_width' => $this->request->getPost('item_width'),
						'item_height' => $this->request->getPost('item_height'),
						'item_hpp' => $this->request->getPost('item_hpp'),
						'item_stock' => $this->request->getPost('item_stock'),
						'item_before_sale' => $this->request->getPost('item_sale'),
						'item_discount' => $this->request->getPost('item_discount'),
						'item_sale' => $after,
						'item_profit' => $profit,
						'item_description' => ucWords($this->request->getPost('item_description')),
						'category_id' => $this->request->getPost('category'),
						'supplier_id' => $this->request->getPost('supplier'),
					]);
					if ($save) {
						echo "Produk Berhasil Ditambahkan";
					} else {
						echo "Produk Gagal Ditambahkan";
					}
				} else {
					echo "Gagal Memindahkan File Ke Server";
				}
			}
		} else if (!empty($this->request->getPost('update_items'))) {
			if ($this->request->getFile('item_image_up')->getError() == 0) {
				$formSubmit = $this->validate([
					'item_image_up' =>	'uploaded[item_image_up]|max_size[item_image_up,1048]|mime_in[item_image_up,image/png,image/jpg,image/jpeg]|ext_in[item_image_up,jpg,jpeg,png]',
					'item_code_up' => 'required|max_length[25]',
					'item_name_up' => 'required|max_length[200]',
					'item_merk_up' => 'permit_empty|max_length[200]',
					'item_type_up' => 'permit_empty|max_length[200]',
					'item_weight_up' => 'permit_empty',
					'item_length_up' => 'permit_empty',
					'item_width_up' => 'permit_empty',
					'item_height_up' => 'permit_empty',
					'item_hpp_up' => 'required|integer',
					'item_discount' => 'permit_empty',
					'item_stock_up' => 'required|integer',
					'item_sale_up' => 'required',
					'item_description_up' => 'permit_empty|max_length[500]',
					'category_up' => 'required|integer',
					'supplier_up' => 'required|integer',
				]);
			} else {
				$formSubmit = $this->validate([
					'item_code_up' => 'required|max_length[25]',
					'item_name_up' => 'required|max_length[200]',
					'item_merk_up' => 'permit_empty|max_length[200]',
					'item_type_up' => 'permit_empty|max_length[200]',
					'item_weight_up' => 'permit_empty',
					'item_length_up' => 'permit_empty',
					'item_width_up' => 'permit_empty',
					'item_height_up' => 'permit_empty',
					'item_hpp_up' => 'required|integer',
					'item_discount' => 'permit_empty',
					'item_stock_up' => 'required|integer',
					'item_sale_up' => 'required',
					'item_description_up' => 'permit_empty|max_length[500]',
					'category_up' => 'required|integer',
					'supplier_up' => 'required|integer',
				]);
			}
			if (!$formSubmit) {
				return redirect()->to('/items')->withInput();
			} else {
				$find = $this->m_item->find($this->request->getPost('id_item'));
				// Perhitungan discount
				$before = $this->request->getPost('item_sale');
				if (empty($this->request->getPost('item_discount'))) {
					$bil_dis = 0;
				} else {
					$bil_dis = $this->request->getPost('item_discount');
				}
				$discount = ($before * $bil_dis) / 100;
				$after = $before - $discount;
				$profit = $after - $this->request->getPost('item_hpp_up');
				if ($profit <= 0) {
					$profit = 0;
				}
				

				if ($this->request->getFile('item_image_up')->getError() == 0) {
					$fotoProduk = $this->request->getFile('item_image_up');
					$namaProduk = $fotoProduk->getRandomName();
					$fotoProduk->move('upload/produk', $namaProduk);
					$move = $this->crop
						->withFile('upload/produk/' . $namaProduk)
						->fit(200, 200, 'center')
						->save('upload/produk/' . $namaProduk);
					if ($move) {
						if (unlink('upload/produk/' . $find->item_image)) {
							$save = $this->m_item->save([
								'id' => $this->request->getPost('id_item'),
								'item_image' => $namaProduk,
								'item_code' => $this->request->getPost('item_code_up'),
								'item_name' => ucWords($this->request->getPost('item_name_up')),
								'item_merk' => ucWords($this->request->getPost('item_merk_up')),
								'item_type' =>  ucWords($this->request->getPost('item_type_up')),
								'item_weight' => $this->request->getPost('item_weight_up'),
								'item_length' => $this->request->getPost('item_length_up'),
								'item_width' => $this->request->getPost('item_width_up'),
								'item_height' => $this->request->getPost('item_height_up'),
								'item_hpp' => $this->request->getPost('item_hpp_up'),
								'item_stock' => $this->request->getPost('item_stock_up'),
								'item_before_sale' => $this->request->getPost('item_sale_up'),
								'item_discount' => $this->request->getPost('item_discount_up'),
								'item_sale' => $after,
								'item_profit' => $profit,
								'item_description' => ucWords($this->request->getPost('item_description_up')),
								'category_id' => $this->request->getPost('category_up'),
								'supplier_id' => $this->request->getPost('supplier_up'),
							]);
							if ($save) {
								echo "Produk Berhasil Diubah";
							} else {
								echo "Produk Gagal Diubah";
							}
						} else {
							echo "Gagal Menghapus Gambar Item Lama";
						}
					} else {
						echo "Gagal Memindahkan File Ke Server";
					}
				} else {

					$save = $this->m_item->save([
						'id' => $this->request->getPost('id_item'),
						'item_code' => $this->request->getPost('item_code_up'),
						'item_name' => ucWords($this->request->getPost('item_name_up')),
						'item_merk' => ucWords($this->request->getPost('item_merk_up')),
						'item_type' =>  ucWords($this->request->getPost('item_type_up')),
						'item_weight' => $this->request->getPost('item_weight_up'),
						'item_length' => $this->request->getPost('item_length_up'),
						'item_width' => $this->request->getPost('item_width_up'),
						'item_height' => $this->request->getPost('item_height_up'),
						'item_hpp' => $this->request->getPost('item_hpp_up'),
						'item_stock' => $this->request->getPost('item_stock_up'),
						'item_before_sale' => $this->request->getPost('item_sale_up'),
						'item_discount' => $this->request->getPost('item_discount_up'),
						'item_sale' => $after,
						'item_profit' => $profit,
						'item_description' => ucWords($this->request->getPost('item_description_up')),
						'category_id' => $this->request->getPost('category_up'),
						'supplier_id' => $this->request->getPost('supplier_up'),
					]);
					if ($save) {
						echo "Produk Berhasil Diubah";
					} else {
						echo "Produk Gagal Diubah";
					}
				}
			}
		} else if (!empty($this->request->getPost('delete_items'))) {
			$find = $this->m_item->find($this->request->getPost('id_item'));
			if (!empty($find)) {
				if ($this->m_item->delete($this->request->getPost('id_item'))) {
					dd($this->request->getPost('id_item'), $find);
					echo "Berhasil Dihapus";
				} else {
					echo "Gagal Dihapus";
				}
				if (unlink('upload/produk/' . $find->item_image)) {
				} else {
					echo "Gagal Menghapus Gambar di Server";
				}
			} else {
				echo "Data Tidak Ditemukan";
			}
		} else {
			return view('Admin/page/items', $data);
		}
	}
}