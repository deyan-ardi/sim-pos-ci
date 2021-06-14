<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddGroupUser extends Seeder
{
	public function run()
	{
		$data = [
			[
				'name' => 'KASIR',
				'description' => 'Group For Kasir User',
			],
			[
				'name' => 'ADMIN',
				'description' => 'Group For Admin User',
			],
			[
				'name' => 'SUPER ADMIN',
				'description' => 'Group For Super Admin User'
			],
			[
				'name' => 'ATASAN',
				'description' => 'Group For Atasan User',
			]
		];
		$this->db->table('auth_groups')->insertBatch($data);
	}
}