<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateItemCategoriesTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'            => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'category_name' => ['type' => 'varchar', 'constraint' => 255],
			'created_at'    => ['type' => 'datetime', 'null' => true],
			'updated_at'    => ['type' => 'datetime', 'null' => true],
			'deleted_at'    => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('item_categories', true);
	}

	public function down()
	{
		$this->forge->dropTable('item_categories', true);
	}
}
