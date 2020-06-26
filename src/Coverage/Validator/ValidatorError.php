<?php

namespace Landingi\QualityTools\Coverage\Validator;

final class ValidatorError
{
    private string $validatorClassName;

    /**
     * @var array<ViolatedMethod>
     */
    private array $methods;

    /**
     * @param array<ViolatedMethod> $methods
     */
    public function __construct(string $validatorClassName, array $methods)
    {
        $this->validatorClassName = $validatorClassName;
        $this->methods = $methods;
    }

    public function getValidatorClassName(): string
    {
        return $this->validatorClassName;
    }

    /**
     * @return array<ViolatedMethod>
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}
