<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Coverage\Result;

interface Presenter
{
    public function present(CoverageValidationResult $validationResult): void;
}
