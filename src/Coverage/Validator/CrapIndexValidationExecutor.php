<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Validator;

use Landingi\QualityTools\Coverage\CoverageValidator;
use Landingi\QualityTools\Coverage\Package\Coverage;
use Landingi\QualityTools\Coverage\Result\CoverageValidationResult;
use Landingi\QualityTools\Coverage\Result\CoverageValidationResultBuilder;
use Landingi\QualityTools\Coverage\ValidationExecutor;

class CrapIndexValidationExecutor implements ValidationExecutor
{
    /**
     * @var CoverageValidator[]
     */
    private array $validators;

    public function __construct()
    {
        $this->validators = [];
    }

    /**
     * @return array<CoverageValidator>
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    public function registerValidator(CoverageValidator $validator): void
    {
        $this->validators[] = $validator;
    }

    public function execute(Coverage $coverage): CoverageValidationResult
    {
        $resultBuilder = new CoverageValidationResultBuilder();
        $resultBuilder->succeeded();

        foreach ($this->validators as $validator) {
            $errors = $validator->validate($coverage);

            if (!empty($errors)) {
                $resultBuilder->addValidatorError(get_class($validator), $errors);
            }
        }

        return $resultBuilder
            ->build();
    }
}
