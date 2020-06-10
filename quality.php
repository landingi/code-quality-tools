<?php

require __DIR__ . '/vendor/autoload.php';

use Landingi\QualityTools\Console\CoverageValidatorCommand;
use Symfony\Component\Console\Application;

define('ROOT_DIRECTORY', dirname(__DIR__));

$application = new Application();
$application->add(new CoverageValidatorCommand());
$application->run();
