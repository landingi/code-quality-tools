<?php declare(strict_types = 1);

namespace Landingi\QualityTools\Result;

interface Result
{
    public function hasSucceeded(): bool;

    public function hasFailed(): bool;
}
