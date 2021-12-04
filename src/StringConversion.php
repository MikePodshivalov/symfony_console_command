<?php

namespace App;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class StringConversion extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('string_conversion')
            ->setDescription('does string conversion')
            ->addArgument('arrayString', InputArgument::IS_ARRAY, 'The array of strings to conversion')
            ->addOption('mode',null,InputOption::VALUE_OPTIONAL,
                'Change mode of conversion',false)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $string = implode(' ', $input->getArgument('arrayString'));
        $conversionString = '';
        $mode = (bool)$input->getOption('mode');

        for ($i=0; $i < strlen($string); $i++) {
            $letter = substr($string, $i, 1);
            if ($i%2) {
                $conversionString .= $mode ? strtoupper($letter) : strtolower($letter);
            } else {
                $conversionString .= $mode ? strtolower($letter) : strtoupper($letter);
            }
        }

        $output->writeln('Conversion string: ' . $conversionString);
        return Command::SUCCESS;
    }
}
