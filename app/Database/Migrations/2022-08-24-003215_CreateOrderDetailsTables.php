<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderDetailsTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'detail_quantity' => ['type' => 'int'],
			'receiving_total' => ['type' => 'int'],
			'progress_total'  => ['type' => 'int'],
			'retur_total'     => ['type' => 'int'],
			'retur_remark'    => ['type' => 'text', 'null' => true],
			'status_order'    => ['type' => 'int'],
			'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'order_id'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'item_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'      => ['type' => 'datetime', 'null' => true],
			'updated_at'      => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'item_id', 'sale_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('order_id', 'orders', 'id', false, 'CASCADE');
		$this->forge->createTable('order_details', true);
	}

	public function down()
	{
		$this->forge->dropTable('order_details', true);
	}
}
