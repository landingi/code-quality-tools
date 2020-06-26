<?php

namespace Landingi\QualityTools\Coverage\Validator\Presenter;

use Landingi\QualityTools\Coverage\Result\CoverageValidationResult;
use Landingi\QualityTools\Coverage\Result\Presenter;
use Landingi\QualityTools\Coverage\Validator\ValidatorError;
use Landingi\QualityTools\Coverage\Validator\ViolatedMethod;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ValidatorResultTablePresenter implements Presenter
{
    private SymfonyStyle $io;

    public function __construct(SymfonyStyle $io)
    {
        $this->io = $io;
    }

    public function present(CoverageValidationResult $validationResult): void
    {
        if ($validationResult->hasSucceeded()) {
            $this->io->success('All validators succeeded');

            return;
        }

        if ($validationResult->hasFailed()) {
            /** @var ValidatorError $validatorError */
            foreach ($validationResult->getValidatorErrors() as $validatorError) {
                $parsedErrors = [];

                /** @var ViolatedMethod $violatedMethod */
                foreach ($validatorError->getMethods() as $violatedMethod) {
                    $parsedErrors[] = [
                        $violatedMethod->getParentClass(),
                        $violatedMethod->getName(),
                        $violatedMethod->getMessage()
                    ];
                }

                $this->io->error(sprintf('Validation violation for %s!', $validatorError->getValidatorClassName()));
                $this->io->table(['className', 'methodName', 'message'], $parsedErrors);
            }
        }
    }
}
