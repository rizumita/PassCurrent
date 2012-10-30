<?php
class Model_Pass extends \Orm\Model
{
    const PKBarcodeFormatQR = 0;
    const PKBarcodeFormatPDF417 = 1;
    const PKBarcodeFormatAztec = 2;

    protected static $_properties = array(
        'id',
        'name',
        'description',
        'logo_text',
        'background_color',
        'foreground_color',
        'label_color',
        'barcode_message',
        'barcode_format',
        'pkpass_name',
        'relevant_date',
        'created_at',
        'updated_at',
    );

    protected static $_has_many = array(
        'locations' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Location',
            'key_to' => 'pass_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        ),
        'fields' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Field',
            'key_to' => 'pass_id',
            'cascade_save' => true,
            'cascade_delete' => true,
        )
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
        $val->add_field('name', 'Name', 'required|max_length[255]');
        $val->add_field('logo_text', 'Logo Text', 'max_length[255]');
        $val->add_field('background_color', 'Background Color', 'max_length[255]');
        $val->add_field('foreground_color', 'Foreground Color', 'max_length[255]');
        $val->add_field('label_color', 'Label Color', 'max_length[255]');
        $val->add_field('barcode_message', 'Barcode Message', 'max_length[255]');
        $val->add_field('barcode_format', 'Barcode Format', 'valid_string[numeric]');

        return $val;
    }

    public function pass_json($pass_type_identifier = '', $team_identifier = '')
    {
        $array = array(
            'formatVersion' => 1,
            'passTypeIdentifier' => $pass_type_identifier,
            'teamIdentifier' => $team_identifier,
            'serialNumber' => '001',
            'organizationName' => '',
            'description' => $this->description,
            'logoText' => $this->logo_text,
        );

        $array['coupon'] = array();

        $set_coupon_fields = function ($fields, $fields_name) use (&$array)
        {
            if (count($fields) > 0)
            {
                $array['coupon'][$fields_name] = array_values(array_map(function ($field)
                {
                    return $field->to_array();
                }, $fields));
            }
        };
        $set_coupon_fields($this->primary_fields(), 'primaryFields');
        $set_coupon_fields($this->secondary_fields(), 'secondaryFields');
        $set_coupon_fields($this->auxiliary_fields(), 'auxiliaryFields');
        $set_coupon_fields($this->back_fields(), 'backFields');

        if (!empty($this->foreground_color))
        {
            $array['foregroundColor'] = 'rgb(' . Color::hex2rgb($this->foreground_color) . ')';
        }
        if (!empty($this->background_color))
        {
            $array['backgroundColor'] = 'rgb(' . Color::hex2rgb($this->background_color) . ')';
        }
        if (!empty($this->label_color))
        {
            $array['labelColor'] = 'rgb(' . Color::hex2rgb($this->label_color) . ')';
        }
        if (!empty($this->locations))
        {
            $array['locations'] = array_map(function ($location)
            {
                return $location->to_array();
            }, array_values($this->locations));
        }

        if (!empty($this->barcode_message))
        {
            $array['barcode'] = array(
                'message' => $this->barcode_message,
                'format' => $this->barcode_format(),
                'messageEncoding' => 'UTF-8');
        }

        if ($this->relevant_date != 0){
            $array['relevantDate'] = date('Y-m-d\TG:i:sP', $this->relevant_date);
        }

        return \Fuel\Core\Format::forge($array)->to_json();
    }

    private function barcode_format()
    {
        if ($this->barcode_format == self::PKBarcodeFormatQR)
        {
            return 'PKBarcodeFormatQR';
        }
        elseif ($this->barcode_format == self::PKBarcodeFormatPDF417)
        {
            return 'PKBarcodeFormatPDF417';
        }
        else
        {
            return 'PKBarcodeFormatAztec';
        }
    }

    public function barcode_format_readable()
    {
        if ($this->barcode_format == self::PKBarcodeFormatQR)
        {
            return 'QR';
        }
        elseif ($this->barcode_format == self::PKBarcodeFormatPDF417)
        {
            return 'PDF417';
        }
        else
        {
            return 'Aztec';
        }
    }

    public function status()
    {
        $manager = new Pass_File_Manager($this);
        if (file_exists($manager->pkpass_path()))
        {
            return 'Generated';
        }
        else
        {
            return 'Not generated';
        }
    }

    public function generate($cert_password = '')
    {
        $manager = new Pass_File_Manager($this);
        $cert = new Certificate($manager->file_path('certificate.p12'), $cert_password);

        if (!$manager->generate_file('pass.json', $this->pass_json($cert->pass_type_identifier(), $cert->team_identifier())))
        {
            return $manager->error;
        }
        if (!$manager->generate_file('manifest.json', $this->manifest($manager->files())))
        {
            return $manager->error;
        }
        if (!$signature = $cert->signature($manager->file_path('manifest.json'), $manager->file_path('signature')))
        {
            return $cert->error;
        }
        if (!$manager->generate_file('signature', $signature))
        {
            return $manager->error;
        }
        if (!$manager->generate_zip())
        {
            return $manager->error;
        }

        return null;
    }

    public function manifest($files)
    {
        $shas = array();

        foreach ($files as $name => $path)
        {
            $shas[$name] = sha1(file_get_contents($path));
        }

        return \Fuel\Core\Format::forge($shas)->to_json();
    }

    public function get_pkpass_name()
    {
        if (!empty($this->pkpass_name))
        {
            return $this->pkpass_name;
        }

        $pkpass_name = \Fuel\Core\Str::random('alpha', 8) . '.pkpass';
        while (Model_Pass::find()->where(array('pkpass_name' => $pkpass_name))->get_one())
        {
            $pkpass_name = \Fuel\Core\Str::random('alpha', 8) . '.pkpass';
        }
        $this->pkpass_name = $pkpass_name;
        $this->save();

        return $this->pkpass_name;
    }

    public function set_primary_field($label = '', $value = '')
    {
        $field = $this->primary_field();

        if (is_null($field))
        {
            $field = Model_Field::forge(array('type' => Model_Field::PrimaryField,
                                              'key' => 'offer',
                                              'label' => $label,
                                              'value' => $value));
            $this->fields[] = $field;
            $this->save();
        }
        else
        {
            $field->label = $label;
            $field->value = $value;
            $field->save();
        }

        return true;
    }

    public function primary_field()
    {
        $fields = $this->primary_fields();

        if (count($fields) > 0)
        {
            return array_shift($fields);
        }
        else
        {
            return null;
        }
    }

    public function primary_fields()
    {
        return $this->fields(Model_Field::PrimaryField);
    }

    public function secondary_fields()
    {
        return $this->fields(Model_Field::SecondaryField);
    }

    public function auxiliary_fields()
    {
        return $this->fields(Model_Field::AuxiliaryField);
    }

    public function back_fields()
    {
        return $this->fields(Model_Field::BackField);
    }

    public function set_field($type, $key, $label, $value, $others)
    {
        $field = Model_Field::forge(array('type' => $type, 'key' => $key, 'label' => $label, 'value' => $value));
        $field->set_others($others);
        $this->fields[] = $field;
        $this->save();
    }

    private function fields($type)
    {
        return array_filter($this->fields, function ($field) use ($type)
        {
            return $field->type == $type;
        });
    }
}
