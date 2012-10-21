<?php

namespace Fuel\Migrations;

class Create_passes
{
	public function up()
	{
		\DBUtil::create_table('passes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'description' => array('type' => 'text', 'null' => true),
			'logo_text' => array('constraint' => 255, 'type' => 'varchar'),
			'identifier' => array('constraint' => 255, 'type' => 'varchar'),
			'background_color' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'foreground_color' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'label_color' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'altitude' => array('type' => 'float', 'null' => true),
			'latitude' => array('type' => 'float', 'null' => true),
			'longitude' => array('type' => 'float', 'null' => true),
			'relevant_text' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'signature' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'logo' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'logo2x' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'icon' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'icon2x' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'strip' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'strip2x' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('passes');
	}
}