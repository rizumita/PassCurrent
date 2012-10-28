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
        'pass_type_identifier',
        'team_identifier',
        'background_color',
        'foreground_color',
        'label_color',
        'barcode_message',
        'barcode_format',
        'offer_value',
        'offer_label',
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
//        $val->add_field('description', 'Description', '');
        $val->add_field('logo_text', 'Logo Text', 'required|max_length[255]');
        $val->add_field('pass_type_identifier', 'Pass Type Identifier', 'required|max_length[255]');
        $val->add_field('team_identifier', 'Team Identifier', 'required|max_length[255]');
        $val->add_field('background_color', 'Background Color', 'max_length[255]');
        $val->add_field('foreground_color', 'Foreground Color', 'max_length[255]');
        $val->add_field('label_color', 'Label Color', 'max_length[255]');
        $val->add_field('thumbnail', 'Thumbnail', 'max_length[255]');
        $val->add_field('thumbnail2x', 'Thumbnail2x', 'max_length[255]');
        $val->add_field('barcode_message', 'Barcode Message', 'max_length[255]');
        $val->add_field('barcode_format', 'Barcode Format', 'valid_string[numeric]');
        $val->add_field('offer_value', 'Offer Value', 'required|max_length[255]');
        $val->add_field('offer_label', 'Offer Label', 'required|max_length[255]');

        return $val;
    }

    public function pass_json()
    {
        $array = array(
            'formatVersion' => 1,
            'passTypeIdentifier' => $this->pass_type_identifier,
            'teamIdentifier' => $this->team_identifier,
            'serialNumber' => '001',
            'organizationName' => '',
            'description' => $this->description,
            'logoText' => $this->logo_text,
            'coupon' => array(
                'primaryFields' => array(
                    'key' => 'offer',
                    'label' => $this->offer_label,
                    'value' => $this->offer_value,
                ))
        );

        if (!empty($this->foreground_color))
        {
            $array['foregroundColor'] = $this->foreground_color;
        }
        if (!empty($this->background_color))
        {
            $array['backgroundColor'] = $this->background_color;
        }
        if (!empty($this->label_color))
        {
            $array['labelColor'] = $this->label_color;
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

    public function get_upload_files($whitelist = array())
    {
        $this->prepare_files_dir();

        $result = array();

        $config = array(
            'path' => \Fuel\Core\Config::get('pass.files_dir') . DS . $this->id,
            'ext_whitelist' => $whitelist,
        );

        \Fuel\Core\Upload::process($config);

        if (\Fuel\Core\Upload::is_valid())
        {
            \Fuel\Core\Upload::save();
            $files = \Fuel\Core\Upload::get_files();
            foreach ($files as $file)
            {
                $name = $file['field'];

                if ($name == 'cert')
                {
                    $name = 'cert.p12';
                }
                else
                {
                    $name .= '.png';
                }

                $this->remove_old_file($this->file_path($name));
                \Fuel\Core\File::rename($file['saved_as'], $this->file_path($name));
            }
        }
        else
        {
            $errors = \Fuel\Core\Upload::get_errors();
            foreach ($errors as $error)
            {
                $name = $error['field'];
                if ($name == 'cert')
                {
                    $name = 'certificate';
                }
                else
                {
                    $name = str_replace('@2x', ' retina', $name);
                }

                $result[] = 'Error ' . $name . ' upload';
            }
        }

        return $result;
    }

    public function status()
    {
        return '';
    }

    public function generate($cert_password = '')
    {
        if (empty($this->pass_type_identifier))
        {
            return 'Set pass type identifier.';
        }
        elseif (empty($this->team_identifier))
        {
            return 'Set team identifier.';
        }
        elseif (empty($this->offer_label))
        {
            return 'Set offer label.';
        }
        elseif (empty($this->offer_value))
        {
            return 'Set offer value.';
        }

        $manager = new Pass_File_Manager($this);
        $manager->generate_file('pass.json', $this->pass_json());
        $manager->generate_file('manifest.json', $this->manifest($manager->files()));
        if ($manager->generate_signature($cert_password)==false) {
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

}
