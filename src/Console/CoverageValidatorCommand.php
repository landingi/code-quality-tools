<?php

namespace Landingi\QualityTools\Console;

use Landingi\QualityTools\Coverage\CrapIndexValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CoverageValidatorCommand extends Command
{
    private const OPTION_COVERAGE_PHP_REPORT_PATH = 'coverage-php-path';
    private const OPTION_CRAP_THRESHOLD = 'crap-threshold';

    protected static $defaultName = 'quality:coverage-validate';

    protected function configure(): void
    {
        $this
            ->setDescription('Checks quality thresholds')
            ->setHelp('This command checks coverage report for indicated thresholds');

        $this->addOption(self::OPTION_COVERAGE_PHP_REPORT_PATH, 'cpp', InputOption::VALUE_REQUIRED, 'PHP coverage report path');
        $this->addOption(self::OPTION_CRAP_THRESHOLD, 'ct', InputOption::VALUE_REQUIRED, 'Minimum crap index threshold value');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption(self::OPTION_COVERAGE_PHP_REPORT_PATH) === null) {
            $io->error('At least one coverage path must be provided');

            return Command::FAILURE;
        }

        $crapThreshold = $input->getOption(self::OPTION_CRAP_THRESHOLD);
        if ($crapThreshold !== null) {
            $crapIndexValidator = new CrapIndexValidator($crapThreshold);
//            $result = $crapIndexValidator->validate();
        }

        return Command::SUCCESS;
    }
}
