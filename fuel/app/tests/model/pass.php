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

    public function test_pass_json()
    {
        $pass = Model_Pass::forge(array('title'=>'test title',
                                        'pass_type_identifier'=>'pass.jp.caph.test-coupon',
                                        'team_identifier' => 'xxxxxxxxx',
                                        'description'=>'desc',
                                        'logo_text'=>'sample',
                                        'barcode_message'=>'message',
                                        'barcode_format'=>0,
                                        'foreground_color'=>'rgb(0,0,0)',
                                        'background_color'=>'rgb(1,1,1)',
                                        'label_color'=>'rgb(2,2,2)',
                                        'offer_label'=>'samaplelabel',
                                        'offer_value'=>'samplevalue',
                                  ));

        $this->assertRegExp('/\{.*"formatVersion":1.*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"serialNumber":"001".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"passTypeIdentifier":"pass\.jp\.caph\.test-coupon".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"teamIdentifier":"xxxxxxxxx".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"description":"desc".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"logoText":"sample".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"barcode":\{"message":"message","format":"PKBarcodeFormatQR","messageEncoding":"UTF-8"\}.*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"foregroundColor":"rgb\(0,0,0\)".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"backgroundColor":"rgb\(1,1,1\)".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"labelColor":"rgb\(2,2,2\)".*\}/', $pass->pass_json());
        $this->assertRegExp('/\{.*"coupon":\{"primaryFields":\{"key":"offer","label":"samaplelabel","value":"samplevalue"\}\}.*\}/', $pass->pass_json());
        var_dump($pass->pass_json());
    }

}