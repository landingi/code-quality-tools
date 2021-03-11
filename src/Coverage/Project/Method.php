<?php declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Project;

final class Method
{
    private string $name;
    private int $crapIndex;

    public function __construct(string $name, int $crapIndex)
    {
        $this->name = $name;
        $this->crapIndex = $crapIndex;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCrapIndex(): int
    {
        return $this->crapIndex;
    }
}
