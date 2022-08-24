<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePphsTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'pph_value'  => ['type' => 'float'],
			'created_at' => ['type' => 'datetime', 'null' => true],
			'updated_at' => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('pphs', true);
	}

	public function down()
	{
		$this->forge->dropTable('pphs', true);
	}
}
