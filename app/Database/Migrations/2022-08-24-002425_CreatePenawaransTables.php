<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePenawaransTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'penawaran_code'     => ['type' => 'varchar', 'constraint' => 50],
			'penawaran_handling' => ['type' => 'float', 'null' => true],
			'penawaran_total'    => ['type' => 'float'],
			'penawaran_pay'      => ['type' => 'float'],
			'penawaran_discount' => ['type' => 'float'],
			'penawaran_profit'   => ['type' => 'float'],
			'penawaran_status'   => ['type' => 'int'],
			'penawaran_ket'      => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
			'user_id'       => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'member_id'     => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
			'created_at'    => ['type' => 'datetime', 'null' => true],
			'updated_at'    => ['type' => 'datetime', 'null' => true],
			'deleted_at'    => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'member_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('member_id', 'members', 'id', false, 'CASCADE');
		$this->forge->createTable('penawarans', true);
	}

	public function down()
	{
		$this->forge->dropTable('penawarans', true);
	}
}
