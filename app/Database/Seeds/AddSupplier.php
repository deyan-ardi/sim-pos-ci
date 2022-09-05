<?php

namespace App\Database\Seeds;

use App\Models\SupplierModel;
use CodeIgniter\Database\Seeder;

class AddSupplier extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/suppliers.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new SupplierModel();
				$object->insert([
					"id" => $data[0],
					"supplier_name" => $data[1] == "NULL" ? NULL : $data[1],
					"supplier_contact" => $data[2] == "NULL" ? NULL : $data[2],
					"supplier_email" => $data[3] == "NULL" ? NULL : $data[3],
					"supplier_address" => $data[4] == "NULL" ? NULL : $data[4],
					"supplier_description" => $data[5] == "NULL" ? NULL : $data[5],
				]);
			}
			$firstline = false;
		}

		fclose($csvFile);
	}
}
