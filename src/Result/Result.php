<?php

namespace Landingi\QualityTools\Result;

interface Result
{
    public function hasSucceeded(): bool;
    public function hasFailed(): bool;
}
