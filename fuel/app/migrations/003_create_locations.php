<?php

namespace Fuel\Migrations;

class Create_locations
{
	public function up()
	{
		\DBUtil::create_table('locations', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'pass_id' => array('constraint' => 11, 'type' => 'int'),
			'latitude' => array('type' => 'double'),
			'longitude' => array('type' => 'double'),
			'altitude' => array('type' => 'double', 'null' => true),
			'relevant_text' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('locations');
	}
}