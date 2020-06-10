<?php

namespace Landingi\QualityTools\Tests\Coverage;

use Landingi\QualityTools\Coverage\CrapIndexValidator;
use PHPUnit\Framework\TestCase;

class CrapIndexValidatorTest extends TestCase
{
    public function testValidationWithPhpCoverageSource(): void
    {
        $validator = new CrapIndexValidator(5);
        $validator->validate(ROOT_DIRECTORY . '/resources/coverage/crap/crappy_test_object.php');
    }
}
