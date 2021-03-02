<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Tests\Coverage\Validator;

use Landingi\QualityTools\Coverage\CloverCoverageParser;
use Landingi\QualityTools\Coverage\Validator\CrapIndex\MethodCrapIndexValidator;
use Landingi\QualityTools\Coverage\Validator\CrapIndexValidationExecutor;
use PHPUnit\Framework\TestCase;

class CrapIndexValidationExecutorTest extends TestCase
{
    public function testProperlyRegisteringValidators(): void
    {
        $crapIndexValidationProcessor = new CrapIndexValidationExecutor();
        $crapIndexValidationProcessor->registerValidator(new MethodCrapIndexValidator(5));

        self::assertCount(1, $crapIndexValidationProcessor->getValidators());
    }

    public function testProperlyExecutingValidations(): void
    {
        $cloverCoverageProcessor = new CloverCoverageParser('resources/coverage/crap/crappy_test_object.xml');
        $coverage = $cloverCoverageProcessor->process();
        $crapIndexValidationProcessor = new CrapIndexValidationExecutor();
        $crapIndexValidationProcessor->registerValidator(new MethodCrapIndexValidator(5));
        $result = $crapIndexValidationProcessor->execute($coverage);

        self::assertFalse($result->hasErrors());
        self::assertCount(0, $result->getValidatorErrors());
        self::assertFalse($result->hasFailed());
    }
}
