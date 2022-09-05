<?php

namespace App\Database\Seeds;

use App\Models\InvoiceSettingModel;
use CodeIgniter\Database\Seeder;

class AddInvoice extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/invoice_settings.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new InvoiceSettingModel();
				$object->insert([
					"id" => $data[0],
					"key" => $data[1] == "NULL" ? NULL : $data[1],
					"value" => $data[2] == "NULL" ? NULL : $data[2],
					"position" => $data[3] == "NULL" ? NULL : $data[3],
					"header" => $data[4] == "NULL" ? NULL : $data[4],
				]);
			}
			$firstline = false;
		}

		fclose($csvFile);
	}
}
