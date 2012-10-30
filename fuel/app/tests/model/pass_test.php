<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/21
 * Time: 9:48
 * To change this template use File | Settings | File Templates.
 */

/**
 * @group Pass
 * @group Model
 */
class Pass_Test extends \Fuel\Core\TestCase
{

    private $pass;

    public function setUp()
    {
        $this->pass = Model_Pass::forge(array('name' => 'test name',
                                              'description' => 'desc',
                                              'logo_text' => 'sample',
                                              'barcode_message' => 'message',
                                              'barcode_format' => 0,
                                        ));
        $this->pass->locations[] = Model_Location::forge(array('latitude' => 1.01, 'longitude' => 1.02));
        $this->pass->locations[] = Model_Location::forge(array('latitude' => 2.03, 'longitude' => 2.04,
                                                               'altitude' => 2.05,
                                                               'relevant_text' => 'text'));
        $this->pass->save();

    }

    public function test_pass_json()
    {
        $this->assertRegExp('/\{.*"formatVersion":1.*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"serialNumber":"001".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"description":"desc".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"logoText":"sample".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"barcode":\{"message":"message","format":"PKBarcodeFormatQR","messageEncoding":"UTF-8"\}.*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"locations":\[\{"latitude":1.01,"longitude":1.02\},\{"latitude":2.03,"longitude":2.04,"altitude":2.05,"relevantText":"text"\}\].*\}/', $this->pass->pass_json());
    }

    public function test_manifest()
    {
        $manager = new Pass_File_Manager($this->pass);
        $manager->generate_file('pass.json', $this->pass->pass_json());

        $manifest = $this->pass->manifest($manager->files());

        $this->assertRegExp('/\{.*"pass.json":".*\}/', $manifest);
    }

    public function test_get_pkpass_name()
    {
        $this->assertNull($this->pass->pkpass_name);

        $this->assertRegExp('/.+\.pkpass/', $this->pass->get_pkpass_name());
        $this->assertRegExp('/.+\.pkpass/', $this->pass->pkpass_name);
    }

    public function test_primary_field()
    {
        $this->assertNull($this->pass->primary_field());

        $this->pass->set_primary_field('testlabel', 'testvalue');

        $this->assertEquals('testlabel', $this->pass->primary_field()->label);
        $this->assertEquals('testvalue', $this->pass->primary_field()->value);
    }

}