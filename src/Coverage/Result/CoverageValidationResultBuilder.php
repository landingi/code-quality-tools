<?php declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Result;

use Landingi\QualityTools\Coverage\Validator\ValidatorError;
use Landingi\QualityTools\Result\ResultBuilder;

final class CoverageValidationResultBuilder implements ResultBuilder
{
    private bool $resultStatus;

    /**
     * @var array<ValidatorError>
     */
    private array $validatorErrors;

    public function __construct()
    {
        $this->resultStatus = false;
        $this->validatorErrors = [];
    }

    public function succeeded(): self
    {
        $this->resultStatus = true;

        return $this;
    }

    public function setResultStatus(bool $resultStatus): self
    {
        $this->resultStatus = $resultStatus;

        return $this;
    }

    public function addValidatorError(ValidatorError $validatorError): self
    {
        $this->validatorErrors[] = $validatorError;
        $this->failed();

        return $this;
    }

    public function failed(): self
    {
        $this->resultStatus = false;

        return $this;
    }

    public function build(): CoverageValidationResult
    {
        return new CoverageValidationResult($this->resultStatus, $this->validatorErrors);
    }
}
