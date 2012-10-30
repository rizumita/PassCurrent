<?php

class Model_Field extends \Orm\Model
{
    const PrimaryField = 0;
    const SecondaryField = 1;
    const AuxiliaryField = 2;

    protected static $_properties = array(
        'id',
        'type',
        'key',
        'label',
        'value',
        'others',
        'pass_id',
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

    public function to_array()
    {
        $array = array(
            'key' => $this->key,
            'label' => $this->label,
            'value' => $this->value,
        );

        $others = unserialize($this->others);

        if (!empty($others))
        {
            foreach ($others as $key => $value)
            {
                $array[$key] = $value;
            }
        }

        return $array;
    }

}
