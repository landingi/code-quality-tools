<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Tests\Coverage;

use Landingi\QualityTools\Coverage\CloverCoverageParser;
use Landingi\QualityTools\Coverage\Validator\CrapIndex\MethodCrapIndexValidator;
use PHPUnit\Framework\TestCase;

class CrapIndexValidatorTest extends TestCase
{
    public function testValidationWithPhpCoverageSource(): void
    {
        $cloverCoverageProcessor = new CloverCoverageParser('resources/coverage/crap/crappy_test_object.xml');
        $coverage = $cloverCoverageProcessor->process();
        $validator = new MethodCrapIndexValidator(5);
        $errors = $validator->validate($coverage);

        $this->assertCount(2, $errors);
    }
}
