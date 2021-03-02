<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage;

use Landingi\QualityTools\Coverage\Package\Coverage;
use Landingi\QualityTools\Coverage\Package\FileClass;
use Landingi\QualityTools\Coverage\Package\Method;
use Landingi\QualityTools\Coverage\Package\Package;
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

        foreach ($this->simpleXml->project->package as $package) {
            $packageAttributes = $package->attributes();

            if (isset($packageAttributes->name)) {
                $name = (string) $packageAttributes->name;
            }

            $coveragePackage = new Package($name ?? null);

            $this->processFiles($package, $coveragePackage);
            $coverage->addPackage($coveragePackage);
        }

        if (!$coverage->isValid()) {
            throw new RuntimeException('Invalid coverage report structure, probably empty.');
        }

        return $coverage;
    }

    private function processFiles(SimpleXMLElement $package, Package $coveragePackage): void
    {
        foreach ($package->file as $file) {
            $classAttributes = $file->class->attributes();

            if (isset($classAttributes->name)) {
                $name = (string) $classAttributes->name;
            }

            $coverageFileClass = new FileClass($name ?? null);
            $this->processMethods($file, $coverageFileClass);
            $coveragePackage->addFileClass($coverageFileClass);
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
