<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TGastos extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_registro'          => [
					'type'           => 'INT',
					'constraint'     => 5,
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'Concepto_gastos'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
			],
			'Monto_gastos'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
			],
			'Fecha'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
			],
	]);
	$this->forge->addKey('id_registro', true);
	$this->forge->createTable('t_gastos');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('t_gastos');
	}
}
