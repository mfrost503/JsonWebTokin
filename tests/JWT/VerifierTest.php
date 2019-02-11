<?php
/**
 * @author Matt Frost<mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage Tests
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\Tests\JWT;

use PHPUnit\Framework\TestCase;
use Tokin\JWT\Verifier;
use Tokin\JWT\JsonWebToken;

class VerifierTest extends TestCase
{
    /**
     * @var array 
     */
    protected $header = ['typ' => 'JWT', 'alg' => 'HS256'];

    /**
     * @var array
     */
    protected $payload = [
        'id' => '123346464',
        'first_name' => 'Test',
        'last_name' => 'McTesterson',
        'email' => 'test@test.com',
        'expires' => 1232142
    ];

    /**
     * @var string
     */
    protected $key = 'abcdefghijklmnop';

    /**
     * @var string
     */
    protected $badKey = '1234566778899';

    /**
     * @var string
     */
    protected $token;

    /**
     * Setup
     */
    protected function setUp()
    {
        $header = $this->base64UrlEncode(json_encode($this->header));
        $payload = $this->base64UrlEncode(json_encode($this->payload));
        $signature_hash = hash_hmac('SHA256', "$header.$payload", $this->key, true);
        $signature = $this->base64UrlEncode($signature_hash);
        $this->token = "$header.$payload.$signature"; 
    }

    /**
     * Tear Down
     */
    protected function tearDown()
    {
        unset($this->token);
    }

    /**
     * Test to ensure that a valid token can be validated
     */
    public function testEnsureTokenWillValidate()
    {
        $verifier = new Verifier();
        $jwt = new JsonWebToken($this->token);
        $this->assertTrue($verifier->verify($jwt, $this->key));
    }

    /**
     * Test to ensure a bad token won't validate
     */
    public function testEnsureInvalidKeyDoesNotVerify()
    {
        $verifier = new Verifier();
        $jwt = new JsonWebToken($this->token);
        $this->assertFalse($verifier->verify($jwt, $this->badKey));
    } 

    /**
     * helper to base64url encode
     *
     * @param mixed $input
     * @return string
     */
    private function base64UrlEncode($input)
    {
        return rtrim(strtr(base64_encode($input), '+/', '-_'), '=');
    }
}
