<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ItemCategoryModel;
use App\Models\ItemModel;
use App\Models\OrderModel;
use App\Models\SaleModel;
use App\Models\SupplierModel;
use Hermawan\DataTables\DataTable;

class Item extends BaseController
{
	public function __construct()
	{
		$this->validate = \Config\Services::validation();
		$this->m_item = new ItemModel();
		$this->m_category = new ItemCategoryModel();
		$this->m_supplier = new SupplierModel();
		$this->crop = \Config\Services::image();
		$this->m_order = new OrderModel();
		$this->m_sale = new SaleModel();
	}

	public function ajaxDatatables()
	{
		$db = db_connect();
		$item = $db->table('items')
			->select('items.id, items.item_image, items.item_code, items.item_name, items.item_merk, items.item_type, items.item_weight, items.item_length, items.item_width, items.item_hpp, items.item_before_sale, items.item_discount, items.item_sale, items.item_profit, items.item_description, items.item_warehouse_a, items.item_warehouse_b, items.item_warehouse_c, items.item_warehouse_d, items.item_stock, items.updated_at, suppliers.supplier_name, item_categories.category_name')
			->join('item_categories', 'item_categories.id = items.category_id')
			->join('suppliers', 'suppliers.id = items.supplier_id');
		return DataTable::of($item)
			->add('action', function ($row) {
				$action = $row;
				return $action;
			})
			->addNumbering('row_number')
			->toJson(true);
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
			if ($this->request->getFile('item_image')->getError() == 0) {
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
					'item_hpp' => 'permit_empty|integer',
					'item_stock_a' => 'required|integer',
					'item_stock_b' => 'required|integer',
					'item_stock_c' => 'required|integer',
					'item_stock_d' => 'required|integer',
					'item_sale' => 'permit_empty',
					'item_description' => 'permit_empty|max_length[500]',
					'category' => 'required|integer',
					'supplier' => 'required|integer',
				]);
			} else {
				$formSubmit = $this->validate([
					'item_code' => 'required|max_length[25]',
					'item_name' => 'required|max_length[200]',
					'item_merk' => 'permit_empty|max_length[200]',
					'item_type' => 'permit_empty|max_length[200]',
					'item_weight' => 'permit_empty',
					'item_length' => 'permit_empty',
					'item_width' => 'permit_empty',
					'item_height' => 'permit_empty',
					'item_discount' => 'permit_empty',
					'item_hpp' => 'permit_empty|integer',
					'item_stock_a' => 'required|integer',
					'item_stock_b' => 'required|integer',
					'item_stock_c' => 'required|integer',
					'item_stock_d' => 'required|integer',
					'item_sale' => 'permit_empty',
					'item_description' => 'permit_empty|max_length[500]',
					'category' => 'required|integer',
					'supplier' => 'required|integer',
				]);
			}
			if (!$formSubmit) {
				return redirect()->to('/items')->withInput();
			} else {
				if ($this->request->getFile('item_image')->getError() == 0) {
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
						if (empty($this->request->getPost('item_discount'))) {
							$bil_dis = 0;
						} else {
							$bil_dis = $this->request->getPost('item_discount');
						}
						$discount = ($before * $bil_dis) / 100;
						$after = $before - $discount;
						$profit = $after - $this->request->getPost('item_hpp');
						if ($profit <= 0) {
							$profit = 0;
						}
						$total = $this->request->getPost('item_stock_a') + $this->request->getPost('item_stock_b') + $this->request->getPost('item_stock_c') + $this->request->getPost('item_stock_d');
						if (in_groups('GUDANG')) {
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
								'item_warehouse_a' => $this->request->getPost('item_stock_a'),
								'item_warehouse_b' => $this->request->getPost('item_stock_b'),
								'item_warehouse_c' => $this->request->getPost('item_stock_c'),
								'item_warehouse_d' => $this->request->getPost('item_stock_d'),
								'item_stock' => $total,
								'item_description' => ucWords($this->request->getPost('item_description')),
								'category_id' => $this->request->getPost('category'),
								'supplier_id' => $this->request->getPost('supplier'),
							]);
						} else {
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
								'item_warehouse_a' => $this->request->getPost('item_stock_a'),
								'item_warehouse_b' => $this->request->getPost('item_stock_b'),
								'item_warehouse_c' => $this->request->getPost('item_stock_c'),
								'item_warehouse_d' => $this->request->getPost('item_stock_d'),
								'item_stock' => $total,
								'item_hpp' => $this->request->getPost('item_hpp'),
								'item_before_sale' => $this->request->getPost('item_sale'),
								'item_discount' => $this->request->getPost('item_discount'),
								'item_sale' => $after,
								'item_profit' => $profit,
								'item_description' => ucWords($this->request->getPost('item_description')),
								'category_id' => $this->request->getPost('category'),
								'supplier_id' => $this->request->getPost('supplier'),
							]);
						}
						if ($save) {
							session()->setFlashdata('berhasil', 'Data Produk Baru Berhasil Ditambahkan');
							return redirect()->to('/items')->withCookies();
						} else {
							session()->setFlashdata('gagal', 'Data Produk Gagal Ditambahkan');
							return redirect()->to('/items')->withCookies();
						}
					} else {
						session()->setFlashdata('gagal', 'File Gagal Dipindahkan Ke Server');
						return redirect()->to('/items')->withCookies();
					}
				} else {
					// Perhitungan discount
					$before = $this->request->getPost('item_sale');
					if (empty($this->request->getPost('item_discount'))) {
						$bil_dis = 0;
					} else {
						$bil_dis = $this->request->getPost('item_discount');
					}
					$discount = ($before * $bil_dis) / 100;
					$after = $before - $discount;
					$profit = $after - $this->request->getPost('item_hpp');
					if ($profit <= 0) {
						$profit = 0;
					}
					$total = $this->request->getPost('item_stock_a') + $this->request->getPost('item_stock_b') + $this->request->getPost('item_stock_c') + $this->request->getPost('item_stock_d');
					if (in_groups('GUDANG')) {
						$save = $this->m_item->save([
							'item_code' => $this->request->getPost('item_code'),
							'item_name' => ucWords($this->request->getPost('item_name')),
							'item_merk' => ucWords($this->request->getPost('item_merk')),
							'item_type' =>  ucWords($this->request->getPost('item_type')),
							'item_weight' => $this->request->getPost('item_weight'),
							'item_length' => $this->request->getPost('item_length'),
							'item_width' => $this->request->getPost('item_width'),
							'item_height' => $this->request->getPost('item_height'),
							'item_warehouse_a' => $this->request->getPost('item_stock_a'),
							'item_warehouse_b' => $this->request->getPost('item_stock_b'),
							'item_warehouse_c' => $this->request->getPost('item_stock_c'),
							'item_warehouse_d' => $this->request->getPost('item_stock_d'),
							'item_stock' => $total,
							'item_description' => ucWords($this->request->getPost('item_description')),
							'category_id' => $this->request->getPost('category'),
							'supplier_id' => $this->request->getPost('supplier'),
						]);
					} else {
						$save = $this->m_item->save([
							'item_code' => $this->request->getPost('item_code'),
							'item_name' => ucWords($this->request->getPost('item_name')),
							'item_merk' => ucWords($this->request->getPost('item_merk')),
							'item_type' =>  ucWords($this->request->getPost('item_type')),
							'item_weight' => $this->request->getPost('item_weight'),
							'item_length' => $this->request->getPost('item_length'),
							'item_width' => $this->request->getPost('item_width'),
							'item_height' => $this->request->getPost('item_height'),
							'item_warehouse_a' => $this->request->getPost('item_stock_a'),
							'item_warehouse_b' => $this->request->getPost('item_stock_b'),
							'item_warehouse_c' => $this->request->getPost('item_stock_c'),
							'item_warehouse_d' => $this->request->getPost('item_stock_d'),
							'item_stock' => $total,
							'item_hpp' => $this->request->getPost('item_hpp'),
							'item_before_sale' => $this->request->getPost('item_sale'),
							'item_discount' => $this->request->getPost('item_discount'),
							'item_sale' => $after,
							'item_profit' => $profit,
							'item_description' => ucWords($this->request->getPost('item_description')),
							'category_id' => $this->request->getPost('category'),
							'supplier_id' => $this->request->getPost('supplier'),
						]);
					}
					if ($save) {
						session()->setFlashdata('berhasil', 'Data Produk Baru Berhasil Ditambahkan');
						return redirect()->to('/items')->withCookies();
					} else {
						session()->setFlashdata('gagal', 'Data Produk Gagal Ditambahkan');
						return redirect()->to('/items')->withCookies();
					}
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
					'item_hpp_up' => 'permit_empty|integer',
					'item_discount' => 'permit_empty',
					'item_stock_a_up' => 'permit_empty|integer',
					'item_stock_b_up' => 'permit_empty|integer',
					'item_stock_c_up' => 'permit_empty|integer',
					'item_stock_d_up' => 'permit_empty|integer',
					'item_sale_up' => 'permit_empty',
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
					'item_hpp_up' => 'permit_empty|integer',
					'item_discount' => 'permit_empty',
					'item_stock_a_up' => 'required|integer',
					'item_stock_b_up' => 'required|integer',
					'item_stock_c_up' => 'required|integer',
					'item_stock_d_up' => 'required|integer',
					'item_sale_up' => 'permit_empty',
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
				$before = $this->request->getPost('item_sale_up');
				if (empty($this->request->getPost('item_discount_up'))) {
					$bil_dis = 0;
				} else {
					$bil_dis = $this->request->getPost('item_discount_up');
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
							$total = $this->request->getPost('item_stock_a_up') + $this->request->getPost('item_stock_b_up') + $this->request->getPost('item_stock_c_up') + $this->request->getPost('item_stock_d_up');
							if (!in_groups('GUDANG')) {
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
									'item_warehouse_a' => $this->request->getPost('item_stock_a_up'),
									'item_warehouse_b' => $this->request->getPost('item_stock_b_up'),
									'item_warehouse_c' => $this->request->getPost('item_stock_c_up'),
									'item_warehouse_d' => $this->request->getPost('item_stock_d_up'),
									'item_stock' => $total,
									'item_before_sale' => $this->request->getPost('item_sale_up'),
									'item_discount' => $this->request->getPost('item_discount_up'),
									'item_sale' => $after,
									'item_profit' => $profit,
									'item_description' => ucWords($this->request->getPost('item_description_up')),
									'category_id' => $this->request->getPost('category_up'),
									'supplier_id' => $this->request->getPost('supplier_up'),
								]);
							} else {
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
									'item_warehouse_a' => $this->request->getPost('item_stock_a_up'),
									'item_warehouse_b' => $this->request->getPost('item_stock_b_up'),
									'item_warehouse_c' => $this->request->getPost('item_stock_c_up'),
									'item_warehouse_d' => $this->request->getPost('item_stock_d_up'),
									'item_stock' => $total,
									'item_description' => ucWords($this->request->getPost('item_description_up')),
									'category_id' => $this->request->getPost('category_up'),
									'supplier_id' => $this->request->getPost('supplier_up'),
								]);
							}
							if ($save) {
								session()->setFlashdata('berhasil', 'Data Produk Yang Dipilih Berhasil Diubah');
								return redirect()->to('/items')->withCookies();
							} else {
								session()->setFlashdata('gagal', 'Data Produk Gagal Diubah');
								return redirect()->to('/items')->withCookies();
							}
						} else {
							session()->setFlashdata('gagal', 'Gagal Memperbaharui Gambar Produk Di Server');
							return redirect()->to('/items')->withCookies();
						}
					} else {
						session()->setFlashdata('gagal', 'File Gambar Produk Gagal Dipindahkan Ke Server');
						return redirect()->to('/items')->withCookies();
					}
				} else {
					$total = $this->request->getPost('item_stock_a_up') + $this->request->getPost('item_stock_b_up') + $this->request->getPost('item_stock_c_up') + $this->request->getPost('item_stock_d_up');
					if (!in_groups('GUDANG')) {

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
							'item_warehouse_a' => $this->request->getPost('item_stock_a_up'),
							'item_warehouse_b' => $this->request->getPost('item_stock_b_up'),
							'item_warehouse_c' => $this->request->getPost('item_stock_c_up'),
							'item_warehouse_d' => $this->request->getPost('item_stock_d_up'),
							'item_stock' => $total,
							'item_before_sale' => $this->request->getPost('item_sale_up'),
							'item_discount' => $this->request->getPost('item_discount_up'),
							'item_sale' => $after,
							'item_profit' => $profit,
							'item_description' => ucWords($this->request->getPost('item_description_up')),
							'category_id' => $this->request->getPost('category_up'),
							'supplier_id' => $this->request->getPost('supplier_up'),
						]);
					} else {
						$save = $this->m_item->save([
							'id' => $this->request->getPost('id_item'),
							'item_code' => $this->request->getPost('item_code_up'),
							'item_name' => ucWords($this->request->getPost('item_name_up')),
							'item_merk' => ucWords($this->request->getPost('item_merk_up')),
							'item_type' =>  ucWords($this->request->getPost('item_type_up')),
							'item_warehouse_a' => $this->request->getPost('item_stock_a_up'),
							'item_warehouse_b' => $this->request->getPost('item_stock_b_up'),
							'item_warehouse_c' => $this->request->getPost('item_stock_c_up'),
							'item_warehouse_d' => $this->request->getPost('item_stock_d_up'),
							'item_stock' => $total,
							'item_weight' => $this->request->getPost('item_weight_up'),
							'item_length' => $this->request->getPost('item_length_up'),
							'item_width' => $this->request->getPost('item_width_up'),
							'item_height' => $this->request->getPost('item_height_up'),
							'item_description' => ucWords($this->request->getPost('item_description_up')),
							'category_id' => $this->request->getPost('category_up'),
							'supplier_id' => $this->request->getPost('supplier_up'),
						]);
					}
					if ($save) {
						session()->setFlashdata('berhasil', 'Data Produk Yang Dipilih Berhasil Diubah');
						return redirect()->to('/items')->withCookies();
					} else {
						session()->setFlashdata('gagal', 'Data Produk Gagal Diubah');
						return redirect()->to('/items')->withCookies();
					}
				}
			}
		} else if (!empty($this->request->getPost('update_posisi_item'))) {
			$formSubmit = $this->validate([
				'item_stock_a_up' => 'required|integer',
				'item_stock_b_up' => 'required|integer',
				'item_stock_c_up' => 'required|integer',
				'item_stock_d_up' => 'required|integer',
			]);
			if (!$formSubmit) {
				return redirect()->to('/items')->withInput();
			} else {
				$find = $this->m_item->find($this->request->getPost('id_item'));
				$total = $this->request->getPost('item_stock_a_up') + $this->request->getPost('item_stock_b_up') + $this->request->getPost('item_stock_c_up') + $this->request->getPost('item_stock_d_up');
				if ($total == $find->item_stock) {
					$save = $this->m_item->save([
						'id' => $this->request->getPost('id_item'),
						'item_warehouse_a' => $this->request->getPost('item_stock_a_up'),
						'item_warehouse_b' => $this->request->getPost('item_stock_b_up'),
						'item_warehouse_c' => $this->request->getPost('item_stock_c_up'),
						'item_warehouse_d' => $this->request->getPost('item_stock_d_up'),
						'item_stock' => $total,
					]);
					if ($save) {
						session()->setFlashdata('berhasil', 'Jumlah Stok di Gudang Berhasil Diubah');
						return redirect()->to('/items')->withCookies();
					} else {
						session()->setFlashdata('gagal', 'Jumlah Stok di Gudang Gagal Diubah');
						return redirect()->to('/items')->withCookies();
					}
				} else {
					session()->setFlashdata('gagal', 'Jumlah Stok Digudang A,B,C,D Harus Sama Dengan Master Stok');
					return redirect()->to('/items')->withCookies();
				}
			}
		} else if (!empty($this->request->getPost('delete_items'))) {
			$find = $this->m_item->find($this->request->getPost('id_item'));
			if (!empty($find)) {
				if (!empty($find->item_image)) {
					unlink('upload/produk/' . $find->item_image);
				}

				if ($this->m_item->delete($this->request->getPost('id_item'))) {
					session()->setFlashdata('berhasil', 'Data Produk Yang Dipilih Berhasil Dihapus');
					return redirect()->to('/items')->withCookies();
				} else {
					session()->setFlashdata('gagal', 'Data Produk Gagal Dihapus');
					return redirect()->to('/items')->withCookies();
				}
			} else {
				session()->setFlashdata('gagal', 'Data Yang Dicari Tidak Ditemukan');
				return redirect()->to('/items')->withCookies();
			}
		} else {
			return view('Admin/page/items', $data);
		}
	}

	public function report()
	{
		$item_in = $this->m_order->getAllOrderWhere();
		$item_out = $this->m_sale->getAllOrderWhere();

		if (!empty($this->request->getGet('filter'))) {
			$item_in_filter = $this->m_order->getAllOrderWhereFilter($this->request->getGet('tanggal_awal'), $this->request->getGet('tanggal_akhir'));
			$item_out_filter = $this->m_sale->getAllOrderWhereFilter($this->request->getGet('tanggal_awal'), $this->request->getGet('tanggal_akhir'));
			$data = [
				'items' => $item_in_filter,
				'item_outs' => $item_out_filter,
			];
			if (!empty($this->request->getPost('export_out'))) {
				if ($this->request->getGet('tanggal_awal') != null && $this->request->getGet('tanggal_akhir') != null) {
					$item_out_filter = $this->m_sale->getAllOrderWhereFilter($this->request->getGet('tanggal_awal'), $this->request->getGet('tanggal_akhir'));
					$data_in = [
						'ket' => 'BARANG KELUAR',
						'barang' => $item_out_filter,
						'awal' => $this->request->getGet('tanggal_awal'),
						'akhir' => $this->request->getGet('tanggal_akhir'),
					];

					$mpdf = new \Mpdf\Mpdf();
					$html = view('Admin/page/invoice_barang_keluar', $data_in);
					$mpdf->WriteHTML($html);
					$mpdf->showImageErrors = true;
					$this->response->setHeader('Content-Type', 'application/pdf');
					$mpdf->Output('Data Barang Masuk.pdf', 'I');
				}
			} else if ($this->request->getPost('export_in')) {
				$data_in = [
					'ket' => 'BARANG MASUK',
					'barang' => $item_in_filter,
					'awal' => $this->request->getGet('tanggal_awal'),
					'akhir' => $this->request->getGet('tanggal_akhir'),
				];
				$mpdf = new \Mpdf\Mpdf();
				$html = view('Admin/page/invoice_barang_masuk', $data_in);
				$mpdf->WriteHTML($html);
				$mpdf->showImageErrors = true;
				$this->response->setHeader('Content-Type', 'application/pdf');
				$mpdf->Output('Data Barang Masuk.pdf', 'I');
			} else {
				return view('Admin/page/report-items', $data);
			}
		} else if (!empty($this->request->getPost('export_out'))) {
			$data_in = [
				'ket' => 'BARANG KELUAR',
				'barang' => $item_out,
				'awal' => null,
				'akhir' => null,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Admin/page/invoice_barang_keluar', $data_in);
			$mpdf->WriteHTML($html);
			$mpdf->showImageErrors = true;
			$this->response->setHeader('Content-Type', 'application/pdf');
			$mpdf->Output('Data Barang Masuk.pdf', 'I');
		} else if (!empty($this->request->getPost('export_in'))) {
			$data_in = [
				'ket' => 'BARANG MASUK',
				'barang' => $item_in,
				'awal' => null,
				'akhir' => null,
			];
			$mpdf = new \Mpdf\Mpdf();
			$html = view('Admin/page/invoice_barang_masuk', $data_in);
			$mpdf->WriteHTML($html);
			$mpdf->showImageErrors = true;
			$this->response->setHeader('Content-Type', 'application/pdf');
			$mpdf->Output('Data Barang Masuk.pdf', 'I');
		} else {
			$data = [
				'items' => $item_in,
				'item_outs' => $item_out,
			];
			return view('Admin/page/report-items', $data);
		}
	}
}
