<?php declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Package;

final class FileClass
{
    private ?string $name;

    /**
     * @var array<Method>
     */
    private array $methods;

    public function __construct(?string $name)
    {
        $this->name = $name;
        $this->methods = [];
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function addMethod(Method $method): void
    {
        $this->methods[] = $method;
    }

    /**
     * @return array<Method>
     */
    public function getMethods(): array
    {
        return $this->methods;
    }
}
