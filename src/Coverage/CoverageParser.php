<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Package\Coverage;

interface CoverageParser
{
    public function process(): Coverage;
}
