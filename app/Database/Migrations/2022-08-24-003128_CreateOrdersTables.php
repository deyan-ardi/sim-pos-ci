<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'order_code'           => ['type' => 'varchar', 'constraint' => 50],
			'order_total_quantity' => ['type' => 'int'],
			'order_total_item'     => ['type' => 'int'],
			'order_status'         => ['type' => 'int'],
			'order_po'             => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'user_id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'supplier_id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'           => ['type' => 'datetime', 'null' => true],
			'updated_at'           => ['type' => 'datetime', 'null' => true],
			'deleted_at'           => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'supplier_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('supplier_id', 'suppliers', 'id', false, 'CASCADE');
		$this->forge->createTable(
			'orders',
			true
		);
	}

	public function down()
	{
		$this->forge->dropTable('orders', true);
	}
}
