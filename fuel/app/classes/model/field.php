<?php

class Model_Field extends \Orm\Model
{
    const PrimaryField = 0;
    const SecondaryField = 1;
    const AuxiliaryField = 2;
    const BackField = 3;

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

    public static function string2type($string)
    {
        $string = strtolower($string);

        if ($string == 'primary')
        {
            return Model_Field::PrimaryField;
        }
        elseif ($string == 'secondary')
        {
            return Model_Field::SecondaryField;
        }
        elseif ($string == 'auxiliary')
        {
            return Model_Field::AuxiliaryField;
        }
        elseif ($string == 'back')
        {
            return Model_Field::BackField;
        }
        else
        {
            return -1;
        }
    }

    public static function type2string($type)
    {
        if ($type == Model_Field::PrimaryField)
        {
            return 'primary';
        }
        elseif ($type == Model_Field::SecondaryField)
        {
            return 'secondary';
        }
        elseif ($type == Model_Field::AuxiliaryField)
        {
            return 'auxiliary';
        }
        elseif ($type == Model_Field::BackField)
        {
            return 'back';
        }
        else
        {
            return '';
        }
    }

    public function set_others($string = '')
    {
        if (!empty($string))
        {
            $array = explode(' ', $string);

            $others = array_filter(array_map(function ($obj)
            {
                preg_match('/(.+):(.+)/', $obj, $matches);
                if (isset($matches[1]) && isset($matches[2]))
                {
                    return array($matches[1] => $matches[2]);
                }
                else
                {
                    return null;
                }
            }, $array), function ($obj)
            {
                return !is_null($obj);
            });

            if (count($others) > 0)
            {
                $this->others = serialize($others);
            }
        }
        else
        {
            $this->others = '';
        }
    }

    public function others_readable()
    {
        $array = unserialize($this->others);

        if (empty($array))
        {
            return '';
        }

        $array = array_map(function ($obj)
        {
            return key($obj) . ':' . $obj[key($obj)];
        }, $array);

        return implode(' ', $array);
    }

}
