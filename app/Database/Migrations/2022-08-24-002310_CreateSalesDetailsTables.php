<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSalesDetailsTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'detail_total'    => ['type' => 'float'],
			'detail_quantity' => ['type' => 'int'],
			'user_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'item_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'sale_id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'      => ['type' => 'datetime', 'null' => true],
			'updated_at'      => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'item_id', 'sale_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('sale_id', 'sales', 'id', false, 'CASCADE');
		$this->forge->createTable('sale_details', true);
	}

	public function down()
	{
		$this->forge->dropTable('sale_details', true);
	}
}
