<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Project\Coverage;
use Landingi\QualityTools\Coverage\Project\FileClass;
use Landingi\QualityTools\Coverage\Project\Method;
use Landingi\QualityTools\Coverage\Project\Project;
use RuntimeException;
use SimpleXMLElement;

final class CloverCoverageParser implements CoverageParser
{
    private SimpleXMLElement $simpleXml;

    public function __construct(string $coverageReportPath)
    {
        $file = file_get_contents($coverageReportPath);

        if (false === $file) {
            throw new RuntimeException('Invalid coverage report file');
        }

        $simpleXML = simplexml_load_string($file);

        if (false === $simpleXML) {
            throw new RuntimeException('Invalid coverage report file');
        }

        $this->simpleXml = $simpleXML;
    }

    public function process(): Coverage
    {
        $coverage = new Coverage();

        foreach ($this->simpleXml->project as $projectData) {
            if (isset($projectData->package)) {
                throw new RuntimeException('Invalid coverage report structure. Old Clover structure is not supported anymore');
            }

            $this->processFiles($projectData, $project = new Project());
            $coverage->addProject($project);
        }

        if (!$coverage->isValid()) {
            throw new RuntimeException('Invalid coverage report structure, probably empty.');
        }

        return $coverage;
    }

    private function processFiles(SimpleXMLElement $project, Project $coverageProject): void
    {
        foreach ($project->file as $file) {
            $classAttributes = $file->class->attributes();

            if (isset($classAttributes->name)) {
                $name = (string) $classAttributes->name;
            }

            $coverageFileClass = new FileClass($name ?? null);
            $this->processMethods($file, $coverageFileClass);
            $coverageProject->addFileClass($coverageFileClass);
        }
    }

    private function processMethods(SimpleXMLElement $file, FileClass $coverageFileClass): void
    {
        foreach ($file->line as $line) {
            $lineAttributes = $line->attributes();

            if (isset($lineAttributes->type) && 'method' !== $lineAttributes->type) {
                continue;
            }

            if (!isset($lineAttributes->name, $lineAttributes->crap)) {
                continue;
            }

            $coverageMethod = new Method((string) $lineAttributes->name, (int) $lineAttributes->crap);
            $coverageFileClass->addMethod($coverageMethod);
        }
    }
}
