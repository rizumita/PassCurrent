<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/27
 * Time: 21:43
 * To change this template use File | Settings | File Templates.
 */

class Pass_File_Manager
{

    private $pass;
    public $error;

    public function Pass_File_Manager($pass)
    {
        $this->pass = $pass;

        if ($this->prepare_files_dir())
        {
            return $this;
        }
        else
        {
            return null;
        }
    }

    public function generate_file($name, $content)
    {
        if ($this->remove_file($this->file_path($name)) == false)
        {
            return false;
        }

        if (\Fuel\Core\File::create($this->files_dir_path(), $name, $content))
        {
            return true;
        }
        else
        {
            $this->error = 'Could not generate ' . $name;
            return false;
        }
    }

    public function generate_signature($cert_password = '')
    {
        if (!file_exists($this->file_path('certificate.p12')))
        {
            $this->error = 'Certificate does not exist.';
            return false;
        }

        $pkcs12 = file_get_contents($this->file_path('certificate.p12'));
        $certs = array();
        if (openssl_pkcs12_read($pkcs12, $certs, $cert_password) == true)
        {
            $cert_data = openssl_x509_read($certs['cert']);
            $private_key = openssl_pkey_get_private($certs['pkey'], $cert_password);

            if (file_exists(\Fuel\Core\Config::get('pass.WWDR_cert')))
            {
                openssl_pkcs7_sign($this->file_path('manifest.json'), $this->file_path('signature'), $cert_data, $private_key, array(), PKCS7_BINARY | PKCS7_DETACHED, \Fuel\Core\Config::get('pass.WWDR_cert'));
            }
            else
            {
                $this->error = 'WWDR Intermediate Certificate does not exist.';
                return false;
            }

            $signature = file_get_contents($this->file_path('signature'));
            $signature = $this->convert_PEM_to_DER($signature);
            \Fuel\Core\File::update($this->files_dir_path(), 'signature', $signature);

            return true;
        }
        else
        {
            $this->error = 'Could not read the certificate.';
            return false;
        }
    }

    public function files()
    {
        $files = array();

        $func = function ($name, $this_obj) use (&$files)
        {
            if (file_exists($this_obj->file_path($name)))
            {
                $files[$name] = $this_obj->file_path($name);
            }
        };

        $func('pass.json', $this);
        $func('background.png', $this);
        $func('background@2x.png', $this);
        $func('footer.png', $this);
        $func('footer@2x.png', $this);
        $func('logo.png', $this);
        $func('logo@2x.png', $this);
        $func('icon.png', $this);
        $func('icon@2x.png', $this);
        $func('strip.png', $this);
        $func('strip@2x.png', $this);
        $func('thumbnail.png', $this);
        $func('thumbnail@2x.png', $this);

        return $files;
    }

    private function prepare_files_dir()
    {
        if (!file_exists($this->files_dir_path()))
        {
            \Fuel\Core\File::create_dir(\Fuel\Core\Config::get('pass.files_dir'), $this->pass->id);
        }

        return file_exists($this->files_dir_path());
    }

    private function remove_file($path = null)
    {
        if (file_exists($path))
        {
            if (\Fuel\Core\File::delete($path))
            {
                return true;
            }
            else
            {
                $this->error = 'Could not delete ' . $path;
                return false;
            }
        }
        else
        {
            return true;
        }
    }

    public function file_path($name)
    {
        return $this->files_dir_path() . DS . $name;
    }

    private function files_dir_path()
    {
        return \Fuel\Core\Config::get('pass.files_dir') . DS . $this->pass->id;
    }

    private function convert_PEM_to_DER($signature)
    {
        $signature = substr($signature, (strpos($signature, 'filename="smime.p7s') + 20));
        return base64_decode(trim(substr($signature, 0, strpos($signature, '------'))));
    }

}