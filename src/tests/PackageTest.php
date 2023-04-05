<?php declare(strict_types=1);

require_once("src/support/helpers.php");

use PHPUnit\Framework\TestCase;
use RazerMerchantServices\Payment as RmsPayment;

final class PackageTest extends TestCase
{
    public function testCanDiscoverThisPackage(): void
    {
        $this->assertTrue(
            class_exists(RmsPayment::class)
        );
    }

    /**
     * @depends testCanDiscoverThisPackage
     */
    public function testCanInstantateBaseClass(): void
    {
        $rms = new RmsPayment(null, null, null, null);

        $this->assertNotNull($rms);
        $this->assertEquals(get_class($rms), RmsPayment::class);
    }
}