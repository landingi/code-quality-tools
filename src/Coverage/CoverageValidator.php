<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Package\Coverage;

interface CoverageValidator
{
    /**
     * @return array<string>
     */
    public function validate(Coverage $coverage): array;
}
