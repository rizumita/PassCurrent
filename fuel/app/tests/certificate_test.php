<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/29
 * Time: 11:03
 * To change this template use File | Settings | File Templates.
 */

/**
 * @group Helper
 * @group Cert
 */
class Certificate_Test extends \Fuel\Core\TestCase
{

    private $pass;
    private $manager;
    private $path;

    public function setUp()
    {
        $files = \Fuel\Core\File::read_dir(APPPATH . 'tests/files', 1);
        foreach ($files as $file => $val)
        {
            \Fuel\Core\File::delete_dir(APPPATH . 'tests/files' . DS . $file);
        }

        $this->pass = Model_Pass::forge(array('name' => 'test name',
                                              'description' => 'desc',
                                              'logo_text' => 'sample',
                                              'barcode_message' => 'message',
                                              'barcode_format' => 0,
                                              'offer_label' => 'samaplelabel',
                                              'offer_value' => 'samplevalue',
                                        ));
        $this->pass->save();

        \Fuel\Core\Config::set('pass.files_dir', APPPATH . 'tests/files');
        $this->path = \Fuel\Core\Config::get('pass.files_dir');

        $this->manager = new Pass_File_Manager($this->pass);
        \Fuel\Core\File::copy(APPPATH . 'tests/certificate.p12', $this->manager->file_path('certificate.p12'));
    }

    public function test_pass_type_identifier()
    {
        $cert = new Certificate(APPPATH . '/tests/certificate.p12');
        $this->assertEquals('pass.jp.caph.generalcoupon', $cert->pass_type_identifier());
    }

    public function test_team_identifier()
    {
        $cert = new Certificate(APPPATH . '/tests/certificate.p12');
        $this->assertEquals('RV6DJ2NMCD', $cert->team_identifier());
    }

    public function test_signature()
    {
        $cert = new Certificate($this->manager->file_path('certificate.p12'));
        $this->manager->generate_file('manifest.json', '');

        $signature = $cert->signature($this->manager->file_path('manifest.json'), $this->manager->file_path('signature'));

        $this->assertNotNull($signature);
    }

}
