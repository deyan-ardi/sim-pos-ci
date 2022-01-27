<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddUserSuperAdmin extends Seeder
{
	public function run()
	{
		$password_super_admon_default = '12345678';
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
		for($i=1;$i <= 6;$i++){
			if($i == 1){
				$email = 'kasir@ganatech.id';
				$username = 'Kasir User';
			}else if($i == 2){
				$email = 'gudang@ganatech.id';
				$username = 'Gudang User';
			} else if ($i == 3) {
				$email = 'super.admin@ganatech.id';
				$username = 'Super Admin User';
			} else if ($i == 4) {
				$email = 'atasan@ganatech.id';
				$username = 'Atasan User';
			} else if ($i == 5) {
				$email = 'purchasing@ganatech.id';
				$username = 'Purchasing User';
			}else{
				$email = 'marketing@ganatech.id';
				$username = 'Marketing User';
			}
			$data_user = [
				[
					'id' => $i,
					'email' => $email,
					'username' => $username,
					'password_hash' => $password,
					'active' => '1',
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				],
			];
			$this->db->table('users')->insertBatch($data_user);
	
			$data_relation = [
				[	'id' => $i,
					'group_id' => $i,
					'user_id' => $i,
				],
			];
			$this->db->table('auth_groups_users')->insertBatch($data_relation);
		}
		$data_member = [
			'member_code' => date('YmdHis'),
			'member_name' => 'General User',
			'member_discount' => 0,
			'member_description' => null,
			'member_email' => 'general@gmail.com',
			'member_status' => 1,
			'member_contact' => 81915656865,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		];
		$this->db->table('members')->insert($data_member);

		$data_pph = [
			'pph_value' => 10,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		];
		$this->db->table('pphs')->insert($data_pph);

		for($i = 1;$i<= 4; $i++){
			if($i == 1){
				$key = 'kiri';
			}else if($i == 2){
				$key = 'tengah';
			}else if($i == 3){
				$key = 'kanan';
			}else if($i == 4){
				$key = 'note';
			}

			$data_invoice = [
				'key' => $key,
				'value' => '',
			];
			
			$this->db->table('invoice_settings')->insert($data_invoice);
		}
	}
}
