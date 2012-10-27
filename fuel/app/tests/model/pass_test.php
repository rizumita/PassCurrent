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
class PassTest extends \Fuel\Core\TestCase
{

    private $pass;

    public function setUp()
    {
        $this->pass = Model_Pass::forge(array('name' => 'test name',
                                              'pass_type_identifier' => 'pass.jp.caph.test-coupon',
                                              'team_identifier' => 'xxxxxxxxx',
                                              'description' => 'desc',
                                              'logo_text' => 'sample',
                                              'barcode_message' => 'message',
                                              'barcode_format' => 0,
                                              'foreground_color' => 'rgb(0,0,0)',
                                              'background_color' => 'rgb(1,1,1)',
                                              'label_color' => 'rgb(2,2,2)',
                                              'offer_label' => 'samaplelabel',
                                              'offer_value' => 'samplevalue',
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
        $this->assertRegExp('/\{.*"passTypeIdentifier":"pass\.jp\.caph\.test-coupon".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"teamIdentifier":"xxxxxxxxx".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"description":"desc".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"logoText":"sample".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"barcode":\{"message":"message","format":"PKBarcodeFormatQR","messageEncoding":"UTF-8"\}.*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"foregroundColor":"rgb\(0,0,0\)".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"backgroundColor":"rgb\(1,1,1\)".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"labelColor":"rgb\(2,2,2\)".*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"coupon":\{"primaryFields":\{"key":"offer","label":"samaplelabel","value":"samplevalue"\}\}.*\}/', $this->pass->pass_json());
        $this->assertRegExp('/\{.*"locations":\[\{"latitude":1.01,"longitude":1.02\},\{"latitude":2.03,"longitude":2.04,"altitude":2.05,"relevantText":"text"\}\].*\}/', $this->pass->pass_json());
    }

    public function test_manifest()
    {
        $manager = new Pass_File_Manager($this->pass);
        $manager->generate_file('pass.json', $this->pass->pass_json());

        $manifest = $this->pass->manifest($manager->files());

        $this->assertRegExp('/\{.*"pass.json":"38b8cd887c1ad0a0cc6dc3aa699cfc12b54dea43".*\}/', $manifest);
    }

}