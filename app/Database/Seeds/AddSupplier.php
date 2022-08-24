<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddSupplier extends Seeder
{
	public function run()
	{
		$data = [
			[
				'supplier_name' => 'Bagus Wirata',
				'supplier_contact' => '6281915656864',
				'supplier_email' => 'baguswirata@gmail.com',
				'supplier_description' => 'Supplier Boba',
				'supplier_address' => 'Denpasar',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'supplier_name' => 'Bayu Cuaca',
				'supplier_contact' => '6281915656865',
				'supplier_email' => 'bayucuaca@gmail.com',
				'supplier_description' => 'Supplier Makanan',
				'supplier_address' => 'Denpasar Bali',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			]
		];
		$this->db->table('suppliers')->insertBatch($data);
	}
}
