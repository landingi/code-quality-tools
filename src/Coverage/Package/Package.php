<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Package;

final class Package
{
    private ?string $name;

    /**
     * @var FileClass[]
     */
    private array $classes;

    public function __construct(?string $name)
    {
        $this->name = $name;
        $this->classes = [];
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function addFileClass(FileClass $fileClass): void
    {
        $this->classes[] = $fileClass;
    }

    /**
     * @return FileClass[]
     */
    public function getClasses(): array
    {
        return $this->classes;
    }
}
