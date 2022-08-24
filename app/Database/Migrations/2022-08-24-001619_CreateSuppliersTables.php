<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSuppliersTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'supplier_name'        => ['type' => 'varchar', 'constraint' => 255],
			'supplier_contact'     => ['type' => 'bigint'],
			'supplier_email'       => ['type' => 'varchar', 'constraint' => 255],
			'supplier_address'     => ['type' => 'text'],
			'supplier_description' => ['type' => 'longtext'],
			'created_at'           => ['type' => 'datetime', 'null' => true],
			'updated_at'           => ['type' => 'datetime', 'null' => true],
			'deleted_at'           => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('suppliers', true);
	}

	public function down()
	{
		$this->forge->dropTable('suppliers', true);
	}
}
