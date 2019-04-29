<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage Tests
 * @subpackage RSA
 * @version 0.1
 * @license MIT
 */
namespace Tokin\Tests\RSA;

use PHPUnit\Framework\TestCase;
use Tokin\RSA\PublicKey;
use Tokin\RSA\X509Certificate;
use Tokin\RSA\PublicKeyService;

class PublicKeyServiceTest extends TestCase
{
    /**
     * @var X509Certificate
     */
    private $certificate;

    /**
     * @var PublicKey
     */
    private $publicKey;

    /**
     * Setup method
     */
    protected function setUp()
    {
        $this->certificate = new X509Certificate();
        $this->publicKey = new PublicKey();
    }

    /**
     * Tear Down
     */
    protected function tearDown()
    {
        unset($this->certificate);
        unset($this->publicKey);
    }

    /**
     * Test to ensure a key can be retrieved properly
     */
    public function testToEnsurePublicKeyCanBeRetrievedProperly()
    {
        $service = new PublicKeyService($this->certificate, $this->publicKey);
        $this->assertInternalType('string', $service->getPublicKey());
    }

    /**
     * Test to ensure null is returned if the keys are empty
     */
    public function testToEnsurePublicKeyIsNullIfKeysAreEmpty()
    {
        $service = new PublicKeyService($this->certificate, $this->publicKey);
        $service->setUrl('http://example.com');
        $this->assertNull($service->getPublicKey());
    }
}
