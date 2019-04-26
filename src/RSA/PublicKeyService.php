<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\RSA;

class PublicKeyService
{
    /**
     * @var string
     */
    protected $url = 'https://budgetdumpster.auth0.com/.well-known/jwks.json';

    /**
     * @var array
     */
    protected $keys = [];

    /**
     * @var X509Certificate
     */
    protected $certificate;

    /**
     * @var PublicKey
     */
    protected $publicKey;

    /**
     * Constructor
     *
     * @param X509Certificate $certificate
     * @param PublicKey $publicKey
     */
    public function __construct(X509Certificate $certificate, PublicKey $publicKey)
    {
        $this->certificate = $certificate;
        $this->publicKey = $publicKey;
        $this->setKeys();
    }

    /**
     * Get the JsonWebKeys
     */
    protected function setKeys()
    {
        $this->keys = json_decode(file_get_contents($this->url), true);
    }   

    /**
     * Get Public Key
     *
     * @return PublicKey
     */
    public function getPublicKey()
    {
        if (empty($this->keys)) {
            return null;
        }

        $certificate_data = $this->keys['keys'][0]['x5c'][0];
        $this->certificate->setData($certificate_data);
        $this->publicKey->setCertificate($this->certificate);
        return $this->publicKey->getKey();
    }
}
