<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/28
 * Time: 5:48
 * To change this template use File | Settings | File Templates.
 */

/**
 * @group Helper
 * @group Pass
 */
class Pass_File_Manager_Test extends \Fuel\Core\TestCase
{
    private $pass;
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
                                              'foreground_color' => 'rgb(0,0,0)',
                                              'background_color' => 'rgb(1,1,1)',
                                              'label_color' => 'rgb(2,2,2)',
                                              'offer_label' => 'samaplelabel',
                                              'offer_value' => 'samplevalue',
                                        ));
        $this->pass->save();

        \Fuel\Core\Config::set('pass.files_dir', APPPATH . 'tests/files');
        $this->path = \Fuel\Core\Config::get('pass.files_dir');

        \Fuel\Core\Config::set('pass.pkpasses_dir', APPPATH . 'tests/passes');
    }

    public function test_generate_file()
    {
        $manager = new Pass_File_Manager($this->pass);
        $manager->generate_file('pass.json', $this->pass->pass_json());
        $manager->generate_file('manifest.json', $this->pass->manifest($manager->files()));

        $this->assertFileExists($this->path . DS . $this->pass->id . DS . 'pass.json');
        $this->assertFileExists($this->path . DS . $this->pass->id . DS . 'manifest.json');
    }

    public function test_files()
    {
        $manager = new Pass_File_Manager($this->pass);
        $manager->generate_file('pass.json', $this->pass->pass_json());
        $manager->generate_file('background.png', 'test');

        $files = $manager->files();

        $this->assertArrayHasKey('pass.json', $files);
        $this->assertArrayHasKey('background.png', $files);
        $this->assertArrayNotHasKey('background@2x.png', $files);

        $this->assertEquals(APPPATH . 'tests/files/' . $this->pass->id . DS . 'pass.json', $files['pass.json']);
        $this->assertEquals(APPPATH . 'tests/files/' . $this->pass->id . DS . 'background.png', $files['background.png']);
    }

    /*
     * テストのためにAPPPATH.'tests/certificate.p12が必要
     */
    public function test_generate_zip()
    {
        $manager = new Pass_File_Manager($this->pass);

        \Fuel\Core\File::copy(APPPATH . 'tests/certificate.p12', $manager->file_path('certificate.p12'));
        $cert_password = '';

        $manager->generate_file('pass.json', $this->pass->pass_json());
        $manager->generate_file('manifest.json', $this->pass->manifest($manager->files()));

        $cert = new Certificate($manager->file_path('certificate.p12'));
        $signature = $cert->signature($manager->file_path('manifest.json'), $manager->file_path('signature'));

        $manager->generate_file('signature', $signature);

        $this->assertTrue($manager->generate_zip());
        $this->assertFileExists($manager->pkpass_path());
    }

    public function test_required_images()
    {
        $manager = new Pass_File_Manager($this->pass);

        $this->assertEquals(12, count($manager->required_images_readable()));

        $manager->generate_file('background.png', '');
        $this->assertEquals(11, count($manager->required_images_readable()));
    }

}