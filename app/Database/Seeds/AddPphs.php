<?php

namespace App\Database\Seeds;

use App\Models\PphModel;
use CodeIgniter\Database\Seeder;

class AddPphs extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/pphs.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new PphModel();
				$object->insert([
					"id" => $data[0],
					"pph_value" => $data[1] == "NULL" ? NULL : $data[1],
				]);
			}
			$firstline = false;
		}

		fclose($csvFile);
	}
}
