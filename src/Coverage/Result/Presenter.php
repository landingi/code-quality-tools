<?php

namespace Landingi\QualityTools\Coverage\Result;

interface Presenter
{
    public function present(CoverageValidationResult $validationResult): void;
}
