<?php declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Project;

final class Coverage
{
    /**
     * @var array<Project>
     */
    private array $projects;

    public function __construct()
    {
        $this->projects = [];
    }

    public function addProject(Project $project): void
    {
        $this->projects[] = $project;
    }

    public function isValid(): bool
    {
        return count($this->projects) > 0;
    }

    /**
     * @return array<Project>
     */
    public function getProjects(): array
    {
        return $this->projects;
    }
}
