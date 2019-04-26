<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\RSA;

use \Exception;

class X509Certificate
{
    /**
     * @var string
     */
    protected $data;

    /**
     * @var certificate
     */
    protected $certificate;

    /**
     * Setter for the data
     *
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get Certificate
     *
     * @return resource
     */
    public function getCertificate()
    {
        $cert = '-----BEGIN CERTIFICATE-----'.PHP_EOL;
        $cert .= chunk_split($this->data, 64, PHP_EOL);
        $cert .= '-----END CERTIFICATE-----';

        $certificate = openssl_x509_read($cert);

        if (is_resource($certificate)) {
            return $certificate;
        }

        throw new Exception("Invalid X509 Certificate");
    }
}
