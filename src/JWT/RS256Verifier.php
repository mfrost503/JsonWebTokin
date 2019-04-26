<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\JWT;

class RS256Verifier implements VerifierInterface
{
    /**
     * @const algorithm
     */
    const ALGORITHM = OPENSSL_ALGO_SH256;

    /**
     * Validate method to satisfy the interface
     *
     * @param JsonWebToken $token
     * @param string $key
     * @return boolean
     */
    public function verify(JsonWebToken $token, $key)
    {
        $signature = $token->getSignature(true);
        $message = $token->getHeader() . '.' . $this->getPayload();
        return openssl_verify($message, $signature, $key, self::ALGORITHM);
    }
    
}
