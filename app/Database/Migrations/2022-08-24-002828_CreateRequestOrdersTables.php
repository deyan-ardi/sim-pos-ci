<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use Composer\Semver\Constraint\Constraint;

class CreateRequestOrdersTables extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'                  => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
			'request_description' => ['type' => 'text'],
			'request_total'       => ['type' => 'int'],
			'request_status'      => ['type' => 'int'],
			'request_po_code'	  => ['type' => 'varchar', 'constraint' => 255, 'null' => true],
			'user_id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'item_id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
			'alasan'              => ['type' => 'text'],
			'created_at'          => ['type' => 'datetime', 'null' => true],
			'updated_at'          => ['type' => 'datetime', 'null' => true],
			'deleted_at'          => ['type' => 'datetime', 'null' => true],
		]);
		$this->forge->addKey('id', true);
		$this->forge->addKey(['user_id', 'item_id']);
		$this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		$this->forge->addForeignKey('item_id', 'items', 'id', false, 'CASCADE');
		$this->forge->createTable('request_orders', true);

	}

	public function down()
	{
		$this->forge->dropTable('request_orders', true);
	}
}
