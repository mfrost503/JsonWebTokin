<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\JWT;

interface VerifierInterface
{
    /**
     * Verification method that needs to be implemented by
     * all verifiers
     *
     * @param JsonWebToken $token
     * @param string $key
     * @return boolean
     */
    public function verify(JsonWebToken $token, $key);
}

