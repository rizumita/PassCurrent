<?php
class Model_Pass extends \Orm\Model
{
    const PKBarcodeFormatQR = 0;
    const PKBarcodeFormatPDF417 = 1;
    const PKBarcodeFormatAztec = 2;

    protected static $_properties = array(
        'id',
        'title',
        'description',
        'logo_text',
        'pass_type_identifier',
        'team_identifier',
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
        'barcode_message',
        'barcode_format',
        'offer_value',
        'offer_label',
        'cert_path',
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
        $val->add_field('pass_type_identifier', 'Pass Type Identifier', 'required|max_length[255]');
        $val->add_field('team_identifier', 'Team Identifier', 'required|max_length[255]');
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
        $val->add_field('barcode_message', 'Barcode Message', 'max_length[255]');
        $val->add_field('barcode_format', 'Barcode Format', 'valid_string[numeric]');
        $val->add_field('offer_value', 'Offer Value', 'required|max_length[255]');
        $val->add_field('offer_label', 'Offer Label', 'required|max_length[255]');
        $val->add_field('cert_path', 'Certification PATH', 'max_length[1023]');

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
}
