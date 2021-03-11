<?php declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Project;

final class Project
{
    /**
     * @var FileClass[]
     */
    private array $classes;

    public function __construct()
    {
        $this->classes = [];
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
