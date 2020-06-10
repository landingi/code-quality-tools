<?php

namespace Landingi\QualityTools\Result;

interface ResultBuilder
{
    public function succeeded(): self;
    public function failed(): self;
    public function setResultStatus(bool $resultStatus): self;
    public function build(): Result;
}
