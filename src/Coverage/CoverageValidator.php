<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Package\Coverage;
use Landingi\QualityTools\Coverage\Validator\ViolatedMethod;

interface CoverageValidator
{
    /**
     * @return array<ViolatedMethod>
     */
    public function validate(Coverage $coverage): array;
}
