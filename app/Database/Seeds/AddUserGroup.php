<?php

namespace App\Database\Seeds;

use App\Models\GroupUserModel;
use CodeIgniter\Database\Seeder;

class AddUserGroup extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/auth_groups_users.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new GroupUserModel();
				$object->insert([
					"id" => $data[0],
					"group_id" => (int)$data[1] == "NULL" ? NULL : $data[1],
					"user_id" => (int)$data[2] == "NULL" ? NULL : $data[2],
				]);
			}
			$firstline = false;
		}
		fclose($csvFile);
	}
}
