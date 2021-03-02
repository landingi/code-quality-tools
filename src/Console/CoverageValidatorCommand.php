<?php declare(strict_types=1);

namespace Landingi\QualityTools\Console;

use InvalidArgumentException;
use Landingi\QualityTools\Coverage\CloverCoverageParser;
use Landingi\QualityTools\Coverage\CoverageParser;
use Landingi\QualityTools\Coverage\Validator\CrapIndex\MethodCrapIndexValidator;
use Landingi\QualityTools\Coverage\Validator\CrapIndexValidationExecutor;
use Landingi\QualityTools\Coverage\Validator\Presenter\ValidatorResultTablePresenter;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use function is_array;
use function sprintf;

final class CoverageValidatorCommand extends Command
{
    private const CODE_FAILURE = 1;
    private const CODE_SUCCESS = 0;
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
        $crapThreshold = $this->getIntegerParameter($input, self::OPTION_CRAP_THRESHOLD);

        if (null !== $crapThreshold) {
            $crapIndexValidationProcessor = new CrapIndexValidationExecutor();
            $crapIndexValidationProcessor->registerValidator(new MethodCrapIndexValidator($crapThreshold));
            $validationResult = $crapIndexValidationProcessor->execute($coverage);

            $validationTablePresenter = new ValidatorResultTablePresenter($io);
            $validationTablePresenter->present($validationResult);

            if ($validationResult->hasFailed()) {
                return self::CODE_FAILURE;
            }
        }

        return self::CODE_SUCCESS;
    }

    private function chooseProcessor(InputInterface $input): CoverageParser
    {
        if (null !== $input->getOption(self::OPTION_COVERAGE_CLOVER_REPORT_PATH)) {
            return new CloverCoverageParser($this->getStringParameter($input, self::OPTION_COVERAGE_CLOVER_REPORT_PATH));
        }

        throw new RuntimeException('There is no supported coverage report provided');
    }

    private function getIntegerParameter(InputInterface $input, string $parameterName): int
    {
        $parameter = $input->getOption($parameterName);

        if (empty($parameter) || is_array($parameter)) {
            throw new InvalidArgumentException(sprintf('Invalid %s parameter exception', $parameterName));
        }

        return (int) $parameter;
    }

    private function getStringParameter(InputInterface $input, string $parameterName): string
    {
        $parameter = $input->getOption($parameterName);

        if (empty($parameter) || is_array($parameter)) {
            throw new InvalidArgumentException(sprintf('Invalid %s parameter exception', $parameterName));
        }

        return (string) $parameter;
    }
}
