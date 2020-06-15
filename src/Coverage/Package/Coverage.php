<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Coverage\Package;

final class Coverage
{
    /**
     * @var array<Package>
     */
    private array $packages;

    public function __construct()
    {
        $this->packages = [];
    }

    public function addPackage(Package $package): void
    {
        $this->packages[] = $package;
    }

    public function isValid(): bool
    {
        return count($this->packages) > 0;
    }

    /**
     * @return array<Package>
     */
    public function getPackages(): array
    {
        return $this->packages;
    }
}
