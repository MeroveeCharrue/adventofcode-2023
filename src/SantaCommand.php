<?php

declare(strict_types=1);

namespace Advent2023;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\SingleCommandApplication;

#[AsCommand(
    name: 'advent:solve',
    description: 'Magically solve puzzles from https://adventofcode.com/2023'
)]
class SantaCommand extends SingleCommandApplication
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Hello there.');

        return Command::SUCCESS;
    }
}
