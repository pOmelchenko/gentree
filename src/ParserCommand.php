<?php

namespace DevOmelchenko\Gentree;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'gentree',
    description: 'Parse CSV and return JSON format',
    hidden: false
)]
class ParserCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to parse CSV file and return JSON format.')
            ->addArgument('inputFile', InputArgument::OPTIONAL, 'The name of input file.')
            ->addArgument('outputFile', InputArgument::OPTIONAL, 'The name of output file.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $inputFileName = $input->getArgument('inputFile');
        $outputFileName = $input->getArgument('outputFile');

        if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $inputFileName)) {
            $output->writeln('Input file [' . $inputFileName . '] exists');
        } else {
            $output->writeln('Input empty');
        }

        if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . $outputFileName)) {
            $output->writeln('Input file [' . $outputFileName . '] exists');
        }

        return Command::SUCCESS;
    }
}
