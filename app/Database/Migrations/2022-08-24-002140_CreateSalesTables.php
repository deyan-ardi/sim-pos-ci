<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'sale_code'     => ['type' => 'varchar', 'constraint' => 50],
			'sale_penawaran_code'     => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
			'sale_handling' => ['type' => 'float', 'null' => true],
			'sale_total'    => ['type' => 'float'],
			'sale_pay'      => ['type' => 'float'],
			'sale_kurang'      => ['type' => 'float'],
			'sale_discount' => ['type' => 'float'],
			'sale_profit'   => ['type' => 'float'],
			'sale_status'   => ['type' => 'int'],
			'sale_send_status'   => ['type' => 'int', 'null' => true],
			'sale_stock_status'   => ['type' => 'int', 'null' => true],
			'sale_ket'      => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
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
		$this->forge->createTable('sales', true);
	}

	public function down()
	{
		$this->forge->dropTable('sales', true);
	}
}
