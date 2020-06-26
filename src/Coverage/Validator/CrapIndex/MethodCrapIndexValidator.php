<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Validator\CrapIndex;

use Landingi\QualityTools\Coverage\CoverageValidator;
use Landingi\QualityTools\Coverage\Package\Coverage;
use Landingi\QualityTools\Coverage\Package\FileClass;
use Landingi\QualityTools\Coverage\Package\Method;
use Landingi\QualityTools\Coverage\Validator\ViolatedMethod;

final class MethodCrapIndexValidator implements CoverageValidator
{
    private int $maximumCrapIndexThreshold;

    public function __construct(int $maximumCrapIndexThreshold)
    {
        $this->maximumCrapIndexThreshold = $maximumCrapIndexThreshold;
    }

    /**
     * @inheritDoc
     */
    public function validate(Coverage $coverage): array
    {
        $result = [];

        foreach ($coverage->getPackages() as $package) {
            foreach ($package->getClasses() as $fileClass) {
                foreach ($fileClass->getMethods() as $method) {
                    $crapIndex = $method->getCrapIndex();
                    $validationResult = $this->processValidation($crapIndex, $fileClass, $method);

                    if ($validationResult !== null) {
                        $result[] = $validationResult;
                    }
                }
            }
        }

        return $result;
    }

    private function processValidation(int $crapIndex, FileClass $fileClass, Method $method): ?ViolatedMethod
    {
        if ($crapIndex > $this->maximumCrapIndexThreshold) {
            return new ViolatedMethod(
                $fileClass->getName(),
                $method->getName(),
                sprintf(
                    'Maximum crap index (%d) threshold has been reached. Current method crap index is: %d!',
                    $this->maximumCrapIndexThreshold,
                    $crapIndex
                )
            );
        }

        return null;
    }
}
