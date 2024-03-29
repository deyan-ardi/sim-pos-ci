<?php

namespace App\Database\Seeds;

use App\Models\ItemCategoryModel;
use CodeIgniter\Database\Seeder;

class AddCategories extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/item_categories.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new ItemCategoryModel();
				$object->insert([
					"id" => $data[0],
					"category_name" => $data[1] == "NULL" ? NULL : $data[1],
				]);
			}
			$firstline = false;
		}

		fclose($csvFile);
	}
}
