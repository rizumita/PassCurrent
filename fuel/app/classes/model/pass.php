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
        'signature',
        'background',
        'background2x',
        'footer',
        'footer2x',
        'logo',
        'logo2x',
        'icon',
        'icon2x',
        'strip',
        'strip2x',
        'thumbnail',
        'thumbnail2x',
        'barcode_message',
        'barcode_format',
        'offer_value',
        'offer_label',
        'cert',
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
        $val->add_field('signature', 'Signature', 'max_length[255]');
        $val->add_field('background', 'Background', 'max_length[255]');
        $val->add_field('background2x', 'Background2x', 'max_length[255]');
        $val->add_field('footer', 'Footer', 'max_length[255]');
        $val->add_field('footer2x', 'Footer2x', 'max_length[255]');
        $val->add_field('logo', 'Logo', 'max_length[255]');
        $val->add_field('logo2x', 'Logo2x', 'max_length[255]');
        $val->add_field('icon', 'Icon', 'max_length[255]');
        $val->add_field('icon2x', 'Icon2x', 'max_length[255]');
        $val->add_field('strip', 'Strip', 'max_length[255]');
        $val->add_field('strip2x', 'Strip2x', 'max_length[255]');
        $val->add_field('thumbnail', 'Thumbnail', 'max_length[255]');
        $val->add_field('thumbnail2x', 'Thumbnail2x', 'max_length[255]');
        $val->add_field('barcode_message', 'Barcode Message', 'max_length[255]');
        $val->add_field('barcode_format', 'Barcode Format', 'valid_string[numeric]');
        $val->add_field('offer_value', 'Offer Value', 'required|max_length[255]');
        $val->add_field('offer_label', 'Offer Label', 'required|max_length[255]');
        $val->add_field('cert', 'Certification Name', 'max_length[255]');

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

    public function prepare_files_dir()
    {
        if (!file_exists($this->files_dir_path()))
        {
            \Fuel\Core\File::create_dir(\Fuel\Core\Config::get('pass.files_dir'), $this->id);
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
                $this->remove_old_file($this->{$file['field']});
                $this->{$file['field']} = $file['saved_as'];
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
                elseif (preg_match('/(.+)2x/', $name, $matches))
                {
                    $name = $matches[1] . ' retina';
                }

                $result[] = 'Error ' . $name . ' upload';
            }
        }

        return $result;
    }

    public
    function files_dir_path()
    {
        return \Fuel\Core\Config::get('pass.files_dir') . DS . $this->id;
    }

    public
    function file_path($name)
    {
        return $this->files_dir_path() . DS . $name;
    }

    public
    function status()
    {
        return '';
    }

    public
    function remove_old_file($name = null)
    {
        if (is_null($name))
        {
            return;
        }

        if (file_exists($this->file_path($name)))
        {
            \Fuel\Core\File::delete($this->file_path($name));
        }
    }
}
