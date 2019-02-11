<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage Tests
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\Tests\JWT;

use PHPUnit\Framework\TestCase;
use Tokin\JWT\JsonWebToken;

class JsonWebTokenTest extends TestCase
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
    protected $token;

    /**
     * Test Setup
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
     * Test Tear Down
     */
    protected function tearDown()
    {
        unset($this->token);
    }

    /**
     * Test to ensure a token can be set and retrieved as is
     */
    public function testEnsureTokenCanBeSetAndRetrieved()
    {
        $token_parts = explode(".", $this->token);
        $header = $token_parts[0];
        $payload = $token_parts[1];
        $signature = $token_parts[2]; 

        $jwt = new JsonWebToken($this->token);

        $this->assertEquals($jwt->getHeader(), $header);
        $this->assertEquals($jwt->getPayload(), $payload);
        $this->assertEquals($jwt->getSignature(), $signature);
        $this->assertEquals($jwt->getOriginalToken(), $this->token);
    }

    /**
     * Test to ensure the JWT contents can be retrieved and decoded
     */
    public function testEnsureTokenComponentsCanBeDecoded()
    {
        $header_json = json_encode($this->header);
        $payload_json = json_encode($this->payload);
        $token_parts = explode(".", $this->token);
        $header = $token_parts[0];
        $payload = $token_parts[1];
        $signature = $token_parts[2]; 

        $jwt = new JsonWebToken($this->token);
        $this->assertEquals($jwt->getHeader(true), $this->header);
        $this->assertEquals($jwt->getPayload(true), $this->payload);
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
