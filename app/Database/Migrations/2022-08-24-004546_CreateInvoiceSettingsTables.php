<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateInvoiceSettingsTables extends Migration
{
	public function up()
	{
		// Invoice Settings
		$this->forge->addField([
			'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'key'        => ['type' => 'varchar', 'constraint' => 100],
			'value'      => ['type' => 'text', 'null' => true],
			'position'   => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
			'header'     => ['type' => 'varchar', 'constraint' => 100, 'null' => true],
			'created_at' => ['type' => 'datetime', 'null' => true],
			'updated_at' => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('invoice_settings', true);
	}

	public function down()
	{
		$this->forge->dropTable('invoice_settings', true);
	}
}
