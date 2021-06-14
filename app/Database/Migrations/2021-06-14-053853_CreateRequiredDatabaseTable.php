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
			'supplier_contact' 		=> ['type' => 'int'],
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
			'member_name' 			=> ['type' => 'varchar', 'constraint' => 255],
			'member_contact' 		=> ['type' => 'int'],
			'member_description'	=> ['type' => 'longtext'],
			'created_at'       		=> ['type' => 'datetime', 'null' => true],
			'updated_at'       		=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       		=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('members', true);

		/*
		Items Migration
		*/
		$this->forge->addField([
			'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'item_code'   	   => ['type' => 'varchar', 'constraint' => 50],
			'item_name'   	   => ['type' => 'varchar', 'constraint' => 255],
			'item_description' => ['type' => 'varchar', 'constraint' => 255],
			'category_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'supplier_id'      => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'       => ['type' => 'datetime', 'null' => true],
			'updated_at'       => ['type' => 'datetime', 'null' => true],
			'deleted_at'       => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['category_id','supplier_id']);
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
			'sale_discount' 	=> ['type' => 'float'],
			'sale_profit' 		=> ['type' => 'float'],
			'user_id'      		=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'member_id'      	=> ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'created_at'       	=> ['type' => 'datetime', 'null' => true],
			'updated_at'       	=> ['type' => 'datetime', 'null' => true],
			'deleted_at'       	=> ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id','member_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('member_id', 'members', 'id', false, 'CASCADE');
		$this->forge->createTable('sales', true);

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
		$this->forge->addKey(['user_id','item_id','sale_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('sale_id', 'sales', 'id', false, 'CASCADE');
		$this->forge->createTable('sale_details', true);


	}
	

	public function down()
	{
		$this->forge->dropTable('item_categories', true);
		$this->forge->dropTable('items', true);
		$this->forge->dropTable('sales', true);
		$this->forge->dropTable('sale_details', true);
		$this->forge->dropTable('suppliers', true);
		$this->forge->dropTable('members', true);
	}
}