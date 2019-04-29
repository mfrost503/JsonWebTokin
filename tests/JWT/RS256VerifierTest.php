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
use Tokin\RSA\PublicKeyService;
use Tokin\RSA\PublicKey;
use Tokin\RSA\X509Certificate;
use Tokin\JWT\RS256Verifier;

class RS256VerifierTest extends TestCase
{
    /**
     * @var JWT
     */
    private $token;

    /**
     * @var string
     */
    private $data = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImtpZCI6IlJrSTNSREV4T0RnM01EZzNRekl3UmpjMk0wUkdRak5CUlRrMk5qUXlPRGhET0RRd1F6SkRRUSJ9.eyJodHRwczovL2J1ZGdldGR1bXBzdGVyLmNvbS9hcHAiOnsiYXV0aG9yaXphdGlvbiI6eyJncm91cHMiOlsiU3RyYXRlZ2ljIFRlY2giXSwicGVybWlzc2lvbnMiOlsicmVhZDpwcmljaW5nIiwid3JpdGU6cHJpY2luZyIsInVwZGF0ZTpwcmljaW5nIiwiZGVsZXRlOnByaWNpbmciLCJyZWFkOmhhdWxlciIsIndyaXRlOmhhdWxlciIsInVwZGF0ZTpoYXVsZXIiLCJkZWxldGU6aGF1bGVyIiwicmVhZDphbGVydCIsInVwZGF0ZTphbGVydCIsIndyaXRlOmFsZXJ0IiwiZGVsZXRlOmFsZXJ0IiwicmVhZDptYXAiLCJ3cml0ZTptYXAiLCJ1cGRhdGU6bWFwIiwiZGVsZXRlOm1hcCIsInJlYWQ6bWFya2V0Iiwid3JpdGU6bWFya2V0IiwidXBkYXRlOm1hcmtldCIsImRlbGV0ZTptYXJrZXQiLCJyZWFkOm5vdGUiLCJ3cml0ZTpub3RlIiwidXBkYXRlOm5vdGUiLCJkZWxldGU6bm90ZSIsInJlYWQ6c2l6ZSIsIndyaXRlOnNpemUiLCJ1cGRhdGU6c2l6ZSIsImRlbGV0ZTpzaXplIiwicmVhZDp0eXBlIiwid3JpdGU6dHlwZSIsInVwZGF0ZTp0eXBlIiwiZGVsZXRlOnR5cGUiXSwicm9sZXMiOlsiU3VwZXIgQWRtaW4iXX19LCJpc3MiOiJodHRwczovL2J1ZGdldGR1bXBzdGVyLmF1dGgwLmNvbS8iLCJzdWIiOiJhdXRoMHw1YzVjNDI3NzY1YzgxNjQwM2VjYzc4ZGQiLCJhdWQiOlsiaW5xdWlzaXRvciIsImh0dHBzOi8vYnVkZ2V0ZHVtcHN0ZXIuYXV0aDAuY29tL3VzZXJpbmZvIl0sImlhdCI6MTU1NjI4OTA2NiwiZXhwIjoxNTU2MzMyMjY2LCJhenAiOiJiNzBKNllGSUJjR1RQRkVXcDBwaDhERkxFeXZXV1o3RSIsInNjb3BlIjoib3BlbmlkIHByb2ZpbGUgZW1haWwgYWRkcmVzcyBwaG9uZSByZWFkOmdyYW50cyByZWFkOnVzZXJfaWRwX3Rva2VucyByZWFkOnVzZXJzIG9mZmxpbmVfYWNjZXNzIiwiZ3R5IjoicGFzc3dvcmQifQ.kqoEL-5drBpKkXOqZ3AYdZh6b7CY951ZCQC_s7an2QGeTdfioSn0hKmK4Ye5FqwOMr4qO85otYku_qAeKkiNv3T8jpWuFMAnAmP6nxKv1C8kgy4dD42ugQI7PNfcRCyOsnN1FLFK6u4DyluHRK2vgds8uRlo_hJJBMvDd99Np5Zi-q96esAA5RIsVSdv2OC_iDexFzzahqu5zzo4FR2IA3DnNSrre-llHg1ANCbMX4ooF8V18a6b9gowi4RYAAJLSOKYiQS6sHhN_uhg_RuhC3WqXro66T1d5T4DF2I6UKFwYpxue5GjdAvHMFXjX0teGPD-PWUW2OiM0RaQdZNqcg';

    /**
     * @var PublicKeyService
     */
    private $publicKeyService;

    /**
     * @var string
     */
    private $key;

    /**
     * Setup
     */
    protected function setUp()
    {
        $this->token = new JsonWebToken($this->data);
        $this->certificate = new X509Certificate();
        $publicKey = new PublicKey();
        $service = new PublicKeyService($this->certificate, $publicKey);
        $this->key = $service->getPublicKey();
    }

    /**
     * Tear Down
     */
    protected function tearDown()
    {
        unset($this->token);
        unset($this->certificate);
        unset($this->key);
    }

    /**
     * Test to ensure a valid token validates with the right key
     */
    public function testTokenValidatesWithRSAPublicKey()
    {
        $verifier = new RS256Verifier();
        $this->assertTrue($verifier->verify($this->token, $this->key));
    }
}
