<?php
declare(strict_types=1);

namespace Landingi\QualityTools\Console;

use Landingi\QualityTools\Coverage\CloverCoverageParser;
use Landingi\QualityTools\Coverage\CoverageParser;
use Landingi\QualityTools\Coverage\Validator\CrapIndex\MethodCrapIndexValidator;
use Landingi\QualityTools\Coverage\Validator\CrapIndexValidationExecutor;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class CoverageValidatorCommand extends Command
{
    private const OPTION_COVERAGE_CLOVER_REPORT_PATH = 'coverage-clover-path';
    private const OPTION_CRAP_THRESHOLD = 'crap-threshold';

    protected static $defaultName = 'quality:coverage-validate';

    protected function configure(): void
    {
        $this
            ->setDescription('Checks quality thresholds')
            ->setHelp('This command checks coverage report for indicated thresholds');

        $this->addOption(
            self::OPTION_COVERAGE_CLOVER_REPORT_PATH,
            'ccr',
            InputOption::VALUE_REQUIRED,
            'Clover format coverage report path'
        );
        $this->addOption(
            self::OPTION_CRAP_THRESHOLD,
            'ct',
            InputOption::VALUE_REQUIRED,
            'Minimum crap index threshold value'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $cloverCoverageParser = $this->chooseProcessor($input);
        $coverage = $cloverCoverageParser->process();
        $crapThreshold = (int) $input->getOption(self::OPTION_CRAP_THRESHOLD);

        if ($crapThreshold !== null) {
            $crapIndexValidationProcessor = new CrapIndexValidationExecutor();
            $crapIndexValidationProcessor->registerValidator(new MethodCrapIndexValidator($crapThreshold));
            $validationResult = $crapIndexValidationProcessor->execute($coverage);

            if ($validationResult->hasFailed()) {
                if ($validationResult->hasErrors()) {
                    $io->block($validationResult->getErrors(), 'ERROR', 'error');
                }

                return Command::FAILURE;
            }
        }

        $io->success('Coverage validation succeeded!');

        return Command::SUCCESS;
    }

    private function chooseProcessor(InputInterface $input): CoverageParser
    {
        if ($input->getOption(self::OPTION_COVERAGE_CLOVER_REPORT_PATH) !== null) {
            return new CloverCoverageParser($input->getOption(self::OPTION_COVERAGE_CLOVER_REPORT_PATH));
        }

        throw new RuntimeException('There is no supported coverage report provided');
    }
}
