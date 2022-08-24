<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembersTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                 => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'member_code'        => ['type' => 'varchar', 'constraint' => 50],
			'member_name'        => ['type' => 'varchar', 'constraint' => 255],
			'member_contact'     => ['type' => 'bigint'],
			'member_description' => ['type' => 'longtext', 'null' => true],
			'member_company'     => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'member_job'         => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'member_discount'    => ['type' => 'float', 'null' => true],
			'member_email'       => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'member_status'      => ['type' => 'int'],
			'created_at'         => ['type' => 'datetime', 'null' => true],
			'updated_at'         => ['type' => 'datetime', 'null' => true],
			'deleted_at'         => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('members', true);
	}

	public function down()
	{
		$this->forge->dropTable('members', true);
	}
}
