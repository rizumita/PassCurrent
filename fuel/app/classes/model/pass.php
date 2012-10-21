<?php
class Model_Pass extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'title',
		'description',
		'logo_text',
		'identifier',
		'background_color',
		'foreground_color',
		'label_color',
		'altitude',
		'latitude',
		'longitude',
		'relevant_text',
		'signature',
		'logo',
		'logo2x',
		'icon',
		'icon2x',
		'strip',
		'strip2x',
		'created_at',
		'updated_at',
	);

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
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('description', 'Description', '');
		$val->add_field('logo_text', 'Logo Text', 'required|max_length[255]');
		$val->add_field('identifier', 'Identifier', 'required|max_length[255]');
		$val->add_field('background_color', 'Background Color', 'max_length[255]');
		$val->add_field('foreground_color', 'Foreground Color', 'max_length[255]');
		$val->add_field('label_color', 'Label Color', 'max_length[255]');
		$val->add_field('altitude', 'Altitude', '');
		$val->add_field('latitude', 'Latitude', '');
		$val->add_field('longitude', 'Longitude', '');
		$val->add_field('relevant_text', 'Relevant Text', 'max_length[255]');
		$val->add_field('signature', 'Signature', 'max_length[255]');
		$val->add_field('logo', 'Logo', 'max_length[255]');
		$val->add_field('logo2x', 'Logo2x', 'max_length[255]');
		$val->add_field('icon', 'Icon', 'max_length[255]');
		$val->add_field('icon2x', 'Icon2x', 'max_length[255]');
		$val->add_field('strip', 'Strip', 'max_length[255]');
		$val->add_field('strip2x', 'Strip2x', 'max_length[255]');

		return $val;
	}

}
