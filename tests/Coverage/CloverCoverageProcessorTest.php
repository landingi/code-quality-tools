<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Tests\Coverage;

use Landingi\QualityTools\Coverage\CloverCoverageParser;
use Landingi\QualityTools\Coverage\Project\Project;
use PHPUnit\Framework\TestCase;

class CloverCoverageProcessorTest extends TestCase
{
    public function testProperlyConstructingCoverageObject(): void
    {
        $cloverCoverageProcessor = new CloverCoverageParser('resources/coverage/crap/crappy_test_object.xml');
        $coverage = $cloverCoverageProcessor->process();

        self::assertNotEmpty($coverage->getProjects());

        foreach ($coverage->getProjects() as $package) {
            self::assertInstanceOf(Project::class, $package);
            self::assertNotEmpty($package->getClasses());

            foreach ($package->getClasses() as $fileClass) {
                foreach ($fileClass->getMethods() as $method) {
                    self::assertNotEmpty($method->getName());
                    self::assertNotEmpty($method->getCrapIndex());
                }
            }
        }
    }
}
