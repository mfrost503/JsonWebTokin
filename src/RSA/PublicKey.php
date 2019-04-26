<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\RSA;

class PublicKey
{
    /**
     * @var X509Certificate
     */
    protected $certificate = null;

    /**
     * Method for setting the certificate
     *
     * @param X509Certificate
     */
    public function setCertificate(X509Certificate $certificate)
    {
        $this->certificate = $certificate;
    }

    /**
     * Method to get the key
     *
     * @return string
     */
    public function getKey()
    {
        if (is_null($this->certificate)) {
            throw new \Exception("Missing Certificate: A Certificate is required to generate a public key");
        }

        $keyObject = openssl_pkey_get_public($this->certificate->getCertificate());
        $keyDetails = openssl_pkey_get_details($keyObject);
        return $keyDetails['key'];
    }
}
