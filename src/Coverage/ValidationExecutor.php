<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Package\Coverage;
use Landingi\QualityTools\Coverage\Result\CoverageValidationResult;

interface ValidationExecutor
{
    /**
     * @return array<CoverageValidator>
     */
    public function getValidators(): array;
    public function registerValidator(CoverageValidator $validator): void;
    public function execute(Coverage $coverage): CoverageValidationResult;
}
