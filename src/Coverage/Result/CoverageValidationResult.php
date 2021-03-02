<?php declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Result;

use Landingi\QualityTools\Coverage\Validator\ValidatorError;
use Landingi\QualityTools\Result\Result;

final class CoverageValidationResult implements Result
{
    private bool $resultStatus;

    /**
     * @var array<ValidatorError>
     */
    private array $errors;

    /**
     * @param array<ValidatorError> $errors
     */
    public function __construct(bool $resultStatus, array $errors = [])
    {
        $this->resultStatus = $resultStatus;
        $this->errors = $errors;
    }

    /**
     * @return array<ValidatorError>
     */
    public function getValidatorErrors(): array
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
