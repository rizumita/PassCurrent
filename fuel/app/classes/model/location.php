<?php

class Model_Location extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'pass_id',
		'latitude',
		'longitude',
		'altitude',
		'relevant_text',
		'created_at',
		'updated_at'
	);

    protected static $_belongs_to = array('pass');

    protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('latitude', 'Latitude', 'required|valid_string[numeric]');
        $val->add_field('longitude', 'Longitude', 'required|valid_string[numeric]');
        $val->add_field('altitude', 'Altitude', 'valid_string[numeric]');
        $val->add_field('relevant_text', 'Relevant Text', 'max_length[255]');

        return $val;
    }
}
