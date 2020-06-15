<?php

namespace Landingi\QualityTools\Coverage\Result;

use Landingi\QualityTools\Result\Result;

final class CoverageValidationResult implements Result
{
    private bool $resultStatus;
    private array $errors;

    public function __construct(bool $resultStatus, array $errors = [])
    {
        $this->resultStatus = $resultStatus;
        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function hasSucceeded(): bool
    {
        return $this->resultStatus;
    }

    public function hasFailed(): bool
    {
        return !$this->resultStatus;
    }
}
