<?php
/**
 * @author Matt Frost <mfrost.design@gmail.com>
 * @package Tokin
 * @subpackage Tests
 * @subpackage JWT
 * @version 0.1
 * @license MIT
 */
namespace Tokin\Tests\RSA;

use PHPUnit\Framework\TestCase;
use Tokin\RSA\X509Certificate;

class X509CertificateTest extends TestCase
{
    /**
     * @var X509Certificate
     */
    private $certificate;

    /**
     * @var string
     */
    private $validKey = 'MIIDCzCCAfOgAwIBAgIJO2Ghovkq7Ih5MA0GCSqGSIb3DQEBCwUAMCMxITAfBgNVBAMTGGJ1ZGdldGR1bXBzdGVyLmF1dGgwLmNvbTAeFw0xOTAxMzAxNzM3MDJaFw0zMjEwMDgxNzM3MDJaMCMxITAfBgNVBAMTGGJ1ZGdldGR1bXBzdGVyLmF1dGgwLmNvbTCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEBAN1JphICusER0zhpLtEq/vATORShMuCWjB6VE4PhBcEc/boynCv16VLi97mbHBzQ174x6RD/7XhG1RoTQF2Pqj08QEctlu/uA6JZSxJEAnxJ2y0iu3s6i3VkSIA4nt2dQ+xl5Vd4BbgaPT6eBxiogRAkG4w7rPN7vIWSQIIDKza7uUs8xwywl3AwtB1YIpNuwiJNujQIRXZtceotEjSdI6+YiEzB1Mp1Zv0NmUGMvH87+Y5cNF9cel3ZpS8X3wm/GRUihwErPM6Whbxn/LgMnVMst2TAZwamjvhZ8mElh459KAlgAXgeYhj6ViT7yMN8m0TqbbzEcNe1+QUBZvRDkmcCAwEAAaNCMEAwDwYDVR0TAQH/BAUwAwEB/zAdBgNVHQ4EFgQUuLwITQSVLiBixNE/3olVm6c06mIwDgYDVR0PAQH/BAQDAgKEMA0GCSqGSIb3DQEBCwUAA4IBAQCvh3L2GsUjBc3xSwHg+8Uqn1lUixyL8SM8xUfy/V0RuYKZk4niCNChTdCHes73QtxTdfaw1WfgBQ/4KyFrVUK9pDrjebLG49JmSEbjXqhOktjEg1J2Fjzocf6bUVP55t1ECsLRFz18aCb1U8T92/162EOeIJuEWHKGEp7pqogEOZt/uCm+e+LUVX8UjqbOsFLBVEiH48IaZ7JOeKS488cbgQ/Fe90xRRrCRpVnPFH5/KMlp44Jl4LX2e6TrNltRBS4v9aPyUdmTjhhxrc0wqGbGMfieAJJ808cn6kFNaAN6fb+lSsHo/zlrR7XeCvX7ewbOyai15ix0nw3GjJ6l3aH';

    /**
     * Setup Method
     */
    protected function setUp()
    {
        $this->certificate = new X509Certificate();
    }

    /**
     * Tear Down Method
     */
    protected function tearDown()
    {
        unset($this->certificate);
    }

    /**
     * Test to ensure a valid key returns a certificate
     */
    public function testValidKeyReturnsCertificate()
    {
        $this->certificate->setData($this->validKey);
        $certificate = $this->certificate->getCertificate();
        $this->assertInternalType('resource', $certificate);
    }

    /**
     * Test to ensure invalid key does not return a certificate
     * @expectedException \Throwable
     */
    public function testInvalidKeyThrowsException()
    {
        $key = '-----BEGIN CERTIFICATE-----'.PHP_EOL;
        $key .= chunk_split($this->validKey, 64, PHP_EOL);
        $key .= '-----END CERTIFICATE-----';

        $this->certificate->setData($key);
        $certificate = $this->certificate->getCertificate();
    }
}
