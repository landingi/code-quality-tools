<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Tests\Coverage;

use Landingi\QualityTools\Coverage\CloverCoverageParser;
use Landingi\QualityTools\Coverage\Package\Package;
use PHPUnit\Framework\TestCase;

class CloverCoverageProcessorTest extends TestCase
{
    public function testProperlyConstructingCoverageObject(): void
    {
        $cloverCoverageProcessor = new CloverCoverageParser('resources/coverage/crap/crappy_test_object.xml');
        $coverage = $cloverCoverageProcessor->process();

        $this->assertNotEmpty($coverage->getPackages());
        foreach ($coverage->getPackages() as $package) {
            $this->assertInstanceOf(Package::class, $package);
            $this->assertNotEmpty($package->getClasses());

            foreach ($package->getClasses() as $fileClass) {
                foreach ($fileClass->getMethods() as $method) {
                    $this->assertNotEmpty($method->getName());
                    $this->assertNotEmpty($method->getCrapIndex());
                }
            }
        }
    }
}
