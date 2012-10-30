<?php
/**
 * Created by JetBrains PhpStorm.
 * User: rizumita
 * Date: 2012/10/29
 * Time: 11:02
 * To change this template use File | Settings | File Templates.
 */

class Certificate
{
    private $path;
    private $cert_password;
    private $certs;
    private $cert_data;
    private $cert_info;

    public $error;

    public function Certificate($path, $cert_password = '')
    {
        $this->path = $path;
        $this->cert_password = $cert_password;

        if (file_exists($this->path) == false)
        {
            return $this;
        }

        $pkcs12 = file_get_contents($this->path);
        if (openssl_pkcs12_read($pkcs12, $this->certs, $cert_password) == true)
        {
            $this->cert_data = openssl_x509_read($this->certs['cert']);
            $this->cert_info = openssl_x509_parse($this->cert_data);
        }

    }

    public function pass_type_identifier()
    {
        if (!empty($this->cert_info) && isset($this->cert_info['subject']['UID']))
        {
            return $this->cert_info['subject']['UID'];
        }

        return false;
    }

    public function team_identifier()
    {
        if (!empty($this->cert_info) && isset($this->cert_info['subject']['OU']))
        {
            return $this->cert_info['subject']['OU'];
        }

        return false;
    }

    public function signature($manifest_path, $signature_path)
    {
        $private_key = openssl_pkey_get_private($this->certs['pkey'], $this->cert_password);

        if (file_exists(\Fuel\Core\Config::get('pass.WWDR_cert')))
        {
            try
            {
                openssl_pkcs7_sign($manifest_path, $signature_path, $this->cert_data, $private_key, array(), PKCS7_BINARY | PKCS7_DETACHED, \Fuel\Core\Config::get('pass.WWDR_cert'));
            }
            catch (Exception $e)
            {
                $this->error = 'Certificate error.';
                return null;
            }
        }
        else
        {
            $this->error = 'WWDR Intermediate Certificate does not exist.';
            return false;
        }

        $signature = file_get_contents($signature_path);
        $signature = $this->convert_PEM2DER($signature);

        return $signature;
    }

    private function convert_PEM2DER($signature)
    {
        $signature = substr($signature, (strpos($signature, 'filename="smime.p7s') + 20));
        return base64_decode(trim(substr($signature, 0, strpos($signature, '------'))));
    }

}