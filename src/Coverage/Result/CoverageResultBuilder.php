<?php

namespace Landingi\QualityTools\Coverage\Result;

use Landingi\QualityTools\Result\ResultBuilder;

final class CoverageResultBuilder implements ResultBuilder
{
    private bool $resultStatus;
    private array $errors;

    public function __construct()
    {
        $this->resultStatus = false;
        $this->errors = [];
    }

    public function succeeded(): self
    {
        $this->resultStatus = true;

        return $this;
    }

    public function failed(): self
    {
        $this->resultStatus = false;

        return $this;
    }

    public function setResultStatus(bool $resultStatus): self
    {
        $this->resultStatus = $resultStatus;

        return $this;
    }

    public function addError($error): self
    {
        $this->errors[] = $error;

        return $this;
    }

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function build(): CoverageResult
    {
        return new CoverageResult($this->resultStatus, $this->errors);
    }
}
