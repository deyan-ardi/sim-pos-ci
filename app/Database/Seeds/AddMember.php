<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddMember extends Seeder
{
	public function run()
	{
		$data = [
			[
				'member_code' => 'MB-202208241',
				'member_name' => 'Deyan Ardi',
				'member_contact' => '081915656863',
				'member_description' => 'Member COntoh',
				'member_company' => 'PT Ganadev Multi Solusi',
				'member_job' => 'CEO',
				'member_discount' => 0,
				'member_email' => 'ganadev@gmail.com',
				'member_status' => 0,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
			[
				'member_code' => 'MB-202208301',
				'member_name' => 'Kadek Angga',
				'member_contact' => '081915656863',
				'member_description' => 'Member Contoh 2',
				'member_company' => 'PT Ganadev Multi Solusi',
				'member_job' => 'CIO',
				'member_discount' => 0,
				'member_email' => 'ganadev2@gmail.com',
				'member_status' => 0,
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
		];
		$this->db->table('members')->insertBatch($data);
	}
}
