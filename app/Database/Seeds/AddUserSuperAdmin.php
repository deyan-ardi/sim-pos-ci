<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddUserSuperAdmin extends Seeder
{
	public function run()
	{
		$password_super_admon_default = 'admin123';
		$hashOptions = [
			'cost' => 10,
		];
		// Enkripsi password
		$password = password_hash(
			base64_encode(
				hash('sha384', $password_super_admon_default, true)
			),
			PASSWORD_DEFAULT,
			$hashOptions
		);
		$data_user = [
			[
				'id' => 1,
				'email' => 'super.admin@ganatech.id',
				'username' => 'Super Admin User',
				'password_hash' => $password,
				'active' => '1',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'),
			],
		];
		$this->db->table('users')->insertBatch($data_user);

		$data_relation = [
			[
				'group_id' => '3',
				'user_id' => '1',
			],
		];
		$this->db->table('auth_groups_users')->insertBatch($data_relation);
	}
}
