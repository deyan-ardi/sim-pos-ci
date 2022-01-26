<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRequiredDatabaseTable extends Migration
{
	public function up()
	{
		/* 
		Item Categories Table
		*/
		$this->forge->addField([
			'id'              => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'category_name'   => ['type' => 'varchar', 'constraint' => 255],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
			'deleted_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('item_categories', true);

		/*
		Supplier Migration
		*/
		$this->forge->addField([
			'id'               		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'supplier_name' 		=> ['type' => 'varchar', 'constraint' => 255],
			'supplier_contact' 		=> ['type' => 'bigint'],
			'supplier_email'		=> ['type' => 'varchar', 'constraint' => 255],
			'supplier_address'		=> ['type' => 'text'],
			'supplier_description'	=> ['type' => 'longtext'],
			'created_at'       		=> ['type' => 'datetime', 'null' => true],
			'updated_at'       		=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       		=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('suppliers', true);

		/*
		Members Migration
		*/
		$this->forge->addField([
			'id'               		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'member_code' 			=> ['type' => 'varchar', 'constraint' => 50],
			'member_name' 			=> ['type' => 'varchar', 'constraint' => 255],
			'member_contact' 		=> ['type' => 'bigint'],
			'member_description'	=> ['type' => 'longtext', 'null' => true],
			'member_company'		=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'member_job'			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'member_discount'		=> ['type' => 'float', 'null' => true],
			'member_email'			=> ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'member_status' 	   	=> ['type' => 'int'],
			'created_at'       		=> ['type' => 'datetime', 'null' => true],
			'updated_at'       		=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       		=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('members', true);

		// /*
		// Items Migration
		// */
		// $this->forge->addField([
		// 	'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
		// 	'item_image'	   => ['type' => 'varchar', 'constraint' => 255],
		// 	'item_code'   	   => ['type' => 'varchar', 'constraint' => 50],
		// 	'item_name'   	   => ['type' => 'varchar', 'constraint' => 255],
		// 	'item_merk'		   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
		// 	'item_type'   	   => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
		// 	'item_weight' 	   => ['type' => 'float', 'null' => true],
		// 	'item_length' 	   => ['type' => 'float', 'null' => true],
		// 	'item_width' 	   => ['type' => 'float', 'null' => true],
		// 	'item_height' 	   => ['type' => 'float', 'null' => true],
		// 	'item_hpp'	 	   => ['type' => 'float', 'null' => true],
		// 	'item_before_sale' => ['type' => 'float', 'null' => true],
		// 	'item_discount'    => ['type' => 'float', 'null' => true],
		// 	'item_sale' 	   => ['type' => 'float', 'null' => true],
		// 	'item_profit' 	   => ['type' => 'float', 'null' => true],
		// 	'item_description' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
		// 	'item_warehouse_a' => ['type' => 'int','default' => 0],
		// 	'item_warehouse_b' => ['type' => 'int','default' => 0],
		// 	'item_warehouse_c' => ['type' => 'int','default' => 0],
		// 	'item_warehouse_d' => ['type' => 'int','default' => 0],
		// 	'item_stock' 	   => ['type' => 'int'],
		// 	'category_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
		// 	'supplier_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
		// 	'created_at'       => ['type' => 'datetime', 'null' => true],
		// 	'updated_at'       => ['type' => 'datetime', 'null' => true],
		// 	'deleted_at'       => ['type' => 'datetime', 'null' => true],
		// ]);
		// $this->forge->addKey('id', true);
		// $this->forge->addKey(['category_id', 'supplier_id']);
		// $this->forge->addForeignKey('category_id', 'item_categories', 'id', false, 'CASCADE');
		// $this->forge->addForeignKey('supplier_id', 'suppliers', 'id', false, 'CASCADE');
		// $this->forge->createTable('items', true);


		/*
		Items Migration
		*/
		$this->forge->addField([
			'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'item_image'	   => ['type' => 'varchar', 'null' => true,'constraint' => 255],
			'item_code'   	   => ['type' => 'varchar', 'null' => true,'constraint' => 50],
			'item_name'   	   => ['type' => 'varchar', 'null' => true,'constraint' => 255],
			'item_merk'		   => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'item_type'   	   => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
			'item_weight' 	   => ['type' => 'float', 'null' => true],
			'item_length' 	   => ['type' => 'float', 'null' => true],
			'item_width' 	   => ['type' => 'float', 'null' => true],
			'item_height' 	   => ['type' => 'float', 'null' => true],
			'item_hpp'	 	   => ['type' => 'float', 'null' => true],
			'item_before_sale' => ['type' => 'float', 'null' => true],
			'item_discount'    => ['type' => 'float', 'null' => true],
			'item_sale' 	   => ['type' => 'float', 'null' => true],
			'item_profit' 	   => ['type' => 'float', 'null' => true],
			'item_description' => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'item_warehouse_a' => ['type' => 'int', 'null' => true,'default' => 0],
			'item_warehouse_b' => ['type' => 'int', 'null' => true,'default' => 0],
			'item_warehouse_c' => ['type' => 'int', 'null' => true,'default' => 0],
			'item_warehouse_d' => ['type' => 'int', 'null' => true,'default' => 0],
			'item_stock' 	   => ['type' => 'int', 'null' => true],
			'category_id'      => ['type' => 'int', 'null' => true,'constraint' => 11, 'unsigned' => true],
			'supplier_id'      => ['type' => 'int', 'null' => true,'constraint' => 11, 'unsigned' => true],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
			'deleted_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['category_id', 'supplier_id']);
		$this->forge->addForeignKey('category_id', 'item_categories', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('supplier_id', 'suppliers', 'id', false, 'CASCADE');
		$this->forge->createTable('items', true);

		/* 
		Sales Migration
		*/
		$this->forge->addField([
			'id'               	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'sale_code'   	   	=> ['type' => 'varchar', 'constraint' => 50],
			'sale_total'   	   	=> ['type' => 'float'],
			'sale_pay'   	   	=> ['type' => 'float'],
			'sale_discount' 	=> ['type' => 'float'],
			'sale_profit' 		=> ['type' => 'float'],
			'sale_status' 		=> ['type' => 'int'],
			'sale_ket'			=> ['type' => 'varchar','constraint' => 50,'null' => true],
			'user_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'member_id'      	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
			'created_at'       	=> ['type' => 'datetime', 'null' => true],
			'updated_at'       	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       	=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'member_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('member_id', 'members', 'id', false, 'CASCADE');
		$this->forge->createTable('sales', true);


		/* 
		Request Order Migration
		*/
		$this->forge->addField([
			'id'               		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'request_description'	=> ['type' => 'text'],
			'request_total' 		=> ['type' => 'int'],
			'request_status' 		=> ['type' => 'int'],
			'user_id'      			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'item_id'      			=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'       		=> ['type' => 'datetime', 'null' => true],
			'updated_at'       		=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       		=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'item_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->createTable('request_orders', true);

		/*
		Sale Details Migration
		*/
		$this->forge->addField([
			'id'               	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'detail_total' 		=> ['type' => 'float'],
			'detail_quantity' 	=> ['type' => 'int'],
			'user_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'item_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'sale_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'       	=> ['type' => 'datetime', 'null' => true],
			'updated_at'       	=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'item_id', 'sale_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('sale_id', 'sales', 'id', false, 'CASCADE');
		$this->forge->createTable('sale_details', true);

		/* 
		Ordering Migration
		*/
		$this->forge->addField([
			'id'               	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'order_code'   	   	=> ['type' => 'varchar', 'constraint' => 50],
			'order_total_quantity' 	=> ['type' => 'int'],
			'order_total_item' 		=> ['type' => 'int'],
			'order_status' 		=> ['type' => 'int'],
			'user_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'supplier_id'      	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'       	=> ['type' => 'datetime', 'null' => true],
			'updated_at'       	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       	=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'supplier_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('supplier_id', 'suppliers', 'id', false, 'CASCADE');
		$this->forge->createTable(
			'orders',
			true
		);


		/*
		Ordering Details Migration
		*/
		$this->forge->addField([
			'id'               	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'detail_quantity' 	=> ['type' => 'int'],
			'user_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'order_id'      	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'item_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'       	=> ['type' => 'datetime', 'null' => true],
			'updated_at'       	=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'item_id', 'sale_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('order_id', 'orders', 'id', false, 'CASCADE');
		$this->forge->createTable('order_details', true);

		/* 
		PPh Migration
		*/
		$this->forge->addField([
			'id'               	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'pph_value'   	   	=> ['type' => 'float'],
			'created_at'       	=> ['type' => 'datetime', 'null' => true],
			'updated_at'       	=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('pphs', true);

	}


	public function down()
	{
		$this->forge->dropTable('item_categories', true);
		$this->forge->dropTable('items', true);
		$this->forge->dropTable('sales', true);
		$this->forge->dropTable('sale_details', true);
		$this->forge->dropTable('suppliers', true);
		$this->forge->dropTable('members', true);
		$this->forge->dropTable('pphs', true);
		$this->forge->dropTable('orders', true);
		$this->forge->dropTable('order_details', true);
	}
}
