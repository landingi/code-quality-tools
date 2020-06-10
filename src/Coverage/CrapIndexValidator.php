<?php

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Result\CoverageResult;
use Landingi\QualityTools\Coverage\Result\CoverageResultBuilder;

final class CrapIndexValidator implements CoverageValidator
{
    private int $maximumCrapIndexThreshold;

    public function __construct(int $maximumCrapIndexThreshold)
    {
        $this->maximumCrapIndexThreshold = $maximumCrapIndexThreshold;
    }

    public function validate(string $coverageReportPath): CoverageResult
    {
        $coverageResultBuilder = new CoverageResultBuilder();



        return $coverageResultBuilder
            ->succeeded()
            ->build();
    }
}
