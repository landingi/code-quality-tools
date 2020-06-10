<?php

namespace Landingi\QualityTools\Coverage;

interface CoverageProcessor
{
    public function process(): CoverageReport;
}
