<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\JWT;

class JsonWebToken
{
    /**
     * @var array
     */
    protected $payload;

    /**
     * @var string
     */
    protected $signature;

    /**
     * @var array
     */
    protected $header;

    /**
     * @var string
     */
    protected $token;

    /**
     * Construct
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
        $token_components = explode(".", $token);
        $this->header = $token_components[0];
        $this->payload = $token_components[1];
        $this->signature = $token_components[2];
    }

    /**
     * Get the header information
     *
     * @param bool decode
     * @return array
     */
    public function getHeader($decode = false)
    {
        if ($decode) {
            return json_decode(base64_decode($this->header), true);
        }
        return $this->header;
    }

    /**
     * Get the payload information
     *
     * @return array
     */
    public function getPayload($decode = false)
    {
        if ($decode) {
            return json_decode(base64_decode($this->payload), true);
        }
        return $this->payload;
    }

    /**
     * Get the signature
     *
     * @return string
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Get the original token
     *
     * @return string
     */
    public function getOriginalToken()
    {
        return $this->token;
    }
}
