<?php

namespace App\Database\Seeds;

use App\Models\MemberModel;
use CodeIgniter\Database\Seeder;

class AddMember extends Seeder
{
	public function run()
	{
		$csvFile = fopen("csv/members.csv", "r");
		// It will automatically read file from /public/csv folder.
		$firstline = true;
		while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
			if (!$firstline) {
				$object = new MemberModel();
				$object->insert([
					"id" => $data[0],
					"member_code" => $data[1] == "NULL" ? NULL : $data[1],
					"member_name" => $data[2] == "NULL" ? NULL : $data[2],
					"member_contact" => $data[3] == "NULL" ? NULL : $data[3],
					"member_description" => $data[4] == "NULL" ? NULL : $data[4],
					"member_company" => $data[5] == "NULL" ? NULL : $data[5],
					"member_job" => $data[6] == "NULL" ? NULL : $data[6],
					"member_discount" => $data[7] == "NULL" ? NULL : $data[7],
					"member_email" => $data[8] == "NULL" ? NULL : $data[8],
					"member_status" => $data[9] == "NULL" ? NULL : $data[9],
				]);
			}
			$firstline = false;
		}

		fclose($csvFile);
	}
}
