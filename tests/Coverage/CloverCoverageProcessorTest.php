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

        foreach ($coverage->getProjects() as $project) {
            self::assertInstanceOf(Project::class, $project);
            self::assertNotEmpty($project->getClasses());

            foreach ($project->getClasses() as $fileClass) {
                foreach ($fileClass->getMethods() as $method) {
                    self::assertNotEmpty($method->getName());
                    self::assertNotEmpty($method->getCrapIndex());
                }
            }
        }
    }
}
