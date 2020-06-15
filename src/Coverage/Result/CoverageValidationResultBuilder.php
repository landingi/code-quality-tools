<?php

namespace Landingi\QualityTools\Coverage\Result;

use Landingi\QualityTools\Result\ResultBuilder;

final class CoverageValidationResultBuilder implements ResultBuilder
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

    public function addError(string $error): self
    {
        $this->errors[] = $error;
        $this->failed();

        return $this;
    }

    public function addValidatorError(string $validatorClassName, array $errors): self
    {
        $this->addError(sprintf("%s -> (\n\t%s\n)", $validatorClassName, implode("\n\t", $errors)));

        return $this;
    }

    public function build(): CoverageValidationResult
    {
        return new CoverageValidationResult($this->resultStatus, $this->errors);
    }
}
