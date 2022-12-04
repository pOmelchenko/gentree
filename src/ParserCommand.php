<?php

namespace DevOmelchenko\Gentree;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'gentree',
    description: 'Parse CSV and return JSON format',
    hidden: false
)]
class ParserCommand extends Command
{
    private const ARGUMENT_NAME_INPUT_FILE = 'inputFile';
    private const ARGUMENT_NAME_OUTPUT_FILE = 'outputFile';
    private const OPTION_NAME_PRETTY = 'pretty';
    private const OPTION_NAME_PRETTY_SHORTCUT = 'p';

    public function __construct(
        private Gentree $gentree,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to parse CSV file and return JSON format.')
            ->addArgument(self::ARGUMENT_NAME_INPUT_FILE, InputArgument::REQUIRED, 'The name of input file.')
            ->addArgument(self::ARGUMENT_NAME_OUTPUT_FILE, InputArgument::OPTIONAL, 'The name of output file.')
            ->addOption(self::OPTION_NAME_PRETTY, self::OPTION_NAME_PRETTY_SHORTCUT, InputOption::VALUE_OPTIONAL, 'Pretty output', false)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFileName = $input->getArgument(self::ARGUMENT_NAME_INPUT_FILE);
        $outputFileName = $input->getArgument(self::ARGUMENT_NAME_OUTPUT_FILE);

        $io = new SymfonyStyle($input, $output);

        if (!file_exists($inputFileName)) {
            $io->error('Lorem Ipsum Dolor Sit Amet');
            return Command::FAILURE;
        }

        $this->gentree->parseFile($inputFileName);

        $pretty = false !== $input->getOption(self::OPTION_NAME_PRETTY);

        if (null === $outputFileName) {
            $io->writeln($this->gentree->toJson($pretty));
        } else {
            file_put_contents($outputFileName, $this->gentree->toJson($pretty));
        }

        return Command::SUCCESS;
    }
}
