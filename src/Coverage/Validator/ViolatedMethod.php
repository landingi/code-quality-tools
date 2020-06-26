<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Coverage\Validator;

final class ViolatedMethod
{
    private string $parentClass;
    private string $name;
    private string $message;

    public function __construct(string $parentClass, string $name, string $message)
    {
        $this->parentClass = $parentClass;
        $this->name = $name;
        $this->message = $message;
    }

    public function getParentClass(): string
    {
        return $this->parentClass;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
