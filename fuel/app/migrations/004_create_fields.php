<?php

namespace Fuel\Migrations;

class Create_fields
{
	public function up()
	{
		\DBUtil::create_table('fields', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'type' => array('constraint' => 11, 'type' => 'int'),
			'key' => array('constraint' => 255, 'type' => 'varchar'),
			'label' => array('constraint' => 255, 'type' => 'varchar'),
			'value' => array('constraint' => 255, 'type' => 'varchar'),
			'others' => array('type' => 'text', 'null' => true),
			'pass_id' => array('constraint' => 11, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('fields');
	}
}