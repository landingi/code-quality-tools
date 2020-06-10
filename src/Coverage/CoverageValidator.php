<?php

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Result\CoverageResult;

interface CoverageValidator
{
    public function validate(string $coverageReportPath): CoverageResult;
}
