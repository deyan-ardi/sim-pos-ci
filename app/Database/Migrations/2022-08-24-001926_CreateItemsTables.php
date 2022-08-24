<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemsTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'item_image'       => ['type' => 'varchar', 'null' => true, 'constraint' => 255],
			'item_code'        => ['type' => 'varchar', 'null' => true, 'constraint' => 50],
			'item_name'        => ['type' => 'varchar', 'null' => true, 'constraint' => 255],
			'item_merk'        => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'item_type'        => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
			'item_weight'      => ['type' => 'float', 'null' => true],
			'item_length'      => ['type' => 'float', 'null' => true],
			'item_width'       => ['type' => 'float', 'null' => true],
			'item_height'      => ['type' => 'float', 'null' => true],
			'item_hpp'         => ['type' => 'float', 'null' => true],
			'item_before_sale' => ['type' => 'float', 'null' => true],
			'item_discount'    => ['type' => 'float', 'null' => true],
			'item_sale'        => ['type' => 'float', 'null' => true],
			'item_profit'      => ['type' => 'float', 'null' => true],
			'item_description' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'item_warehouse_a' => ['type' => 'int', 'null' => true, 'default' => 0],
			'item_warehouse_b' => ['type' => 'int', 'null' => true, 'default' => 0],
			'item_warehouse_c' => ['type' => 'int', 'null' => true, 'default' => 0],
			'item_warehouse_d' => ['type' => 'int', 'null' => true, 'default' => 0],
			'item_stock'       => ['type' => 'int', 'null' => true],
			'category_id'      => ['type' => 'int', 'null' => true, 'constraint' => 11, 'unsigned' => true],
			'supplier_id'      => ['type' => 'int', 'null' => true, 'constraint' => 11, 'unsigned' => true],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
			'deleted_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['category_id', 'supplier_id']);
		$this->forge->addForeignKey('category_id', 'item_categories', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('supplier_id', 'suppliers', 'id', false, 'CASCADE');
		$this->forge->createTable('items', true);
	}

	public function down()
	{
		$this->forge->dropTable('items', true);
	}
}
