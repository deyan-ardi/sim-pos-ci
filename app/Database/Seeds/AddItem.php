<?php

namespace App\Database\Seeds;

use App\Models\ItemModel;
use CodeIgniter\Database\Seeder;

class AddItem extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/items.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new ItemModel();
				$object->insert([
					"id" => $data[0],
					"item_image" => $data[1] == "NULL" ? NULL : $data[1],
					"item_code" => $data[2] == "NULL" ? NULL : $data[2],
					"item_name" => $data[3] == "NULL" ? NULL : $data[3],
					"item_merk" => $data[4] == "NULL" ? NULL : $data[4],
					"item_type" => $data[5] == "NULL" ? NULL : $data[5],
					"item_weight" => $data[6] == "NULL" ? NULL : $data[6],
					"item_length" => $data[7] == "NULL" ? NULL : $data[7],
					"item_width" => $data[8] == "NULL" ? NULL : $data[8],
					"item_height" => $data[9] == "NULL" ? NULL : $data[9],
					"item_hpp" => $data[10] == "NULL" ? NULL : $data[10],
					"item_before_sale" => $data[11] == "NULL" ? NULL : $data[11],
					"item_discount" => $data[12] == "NULL" ? NULL : $data[12],
					"item_sale" => $data[13] == "NULL" ? NULL : $data[13],
					"item_profit" => $data[14] == "NULL" ? NULL : $data[14],
					"item_description" => $data[15] == "NULL" ? NULL : $data[15],
					"item_warehouse_a" => $data[16] == "NULL" ? NULL : $data[16],
					"item_warehouse_b" => $data[17] == "NULL" ? NULL : $data[17],
					"item_warehouse_c" => $data[18] == "NULL" ? NULL : $data[18],
					"item_warehouse_d" => $data[19] == "NULL" ? NULL : $data[19],
					"item_stock" => $data[20] == "NULL" ? NULL : $data[20],
					"category_id" => (int) $data[21] == "NULL" ? NULL : $data[21],
					"supplier_id" => (int) $data[22] == "NULL" ? NULL : $data[22],
				]);
			}
			$firstline = false;
		}
		fclose($csvFile);
	}
}
