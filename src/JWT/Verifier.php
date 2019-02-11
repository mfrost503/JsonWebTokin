<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\JWT;

class Verifier
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var JsonWebToken
     */
    protected $token;

    /**
     * Method to verify the token has been
     * signed and untampered with
     *
     * @param JsonWebToken $token
     * @param string $key
     * @return bool
     */
    public function verify(JsonWebToken $token, $key)
    {
        $header = $token->getHeader();
        $payload = $token->getPayload(); 

        $signature_hash = hash_hmac('sha256', "$header.$payload", $key, true);
        $signature = $this->base64UrlEncode($signature_hash);

        if ($signature === $token->getSignature()) {
            return true;
        }

        return false;
    }

    /**
     * method to base 64 url encode data
     *
     * @param mixed $input
     * @return string
     */
    private function base64UrlEncode($input)
    {
        return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
    }
}
