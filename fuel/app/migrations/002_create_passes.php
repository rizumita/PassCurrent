<?php

namespace Fuel\Migrations;

class Create_passes
{
	public function up()
	{
		\DBUtil::create_table('passes', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'description' => array('type' => 'text', 'null' => true),
			'logo_text' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'background_color' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'foreground_color' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'label_color' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'signature' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'barcode_message' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'barcode_format' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'relevant_date' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'pkpass_name' => array('constraint' => 255, 'type' => 'varchar', 'null' => true),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('passes');
	}
}