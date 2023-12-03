<?php

declare(strict_types=1);

namespace Advent2023\Command;

use Advent2023\Repository\PuzzleLoader;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\SingleCommandApplication;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'advent:solve',
    description: 'Magically solve puzzles from https://adventofcode.com/2023'
)]
class SantaCommand extends SingleCommandApplication
{
    private readonly SymfonyStyle $io;
    private readonly PuzzleLoader $puzzleLoader;

    protected function configure(): void
    {
        $this->addArgument(
            'day',
            InputArgument::OPTIONAL,
            'Which day challenge should we solve ?'
        );
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);
        $this->puzzleLoader = new PuzzleLoader();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io->title('== Advent of code 2023 ==');
        $this->io->text([
            '  <fg=red>Hey</>!',
            'This is <fg=green>Santa</> speaking.',
            'Let\'s get this story going, would ya?'
        ]);

        $this->io->section('Selecting challenge');
        $dayNumber = $this->getDayNumberToSolve($input, $output);
        $this->io->text('Alright, let\'s solve day <fg=green>'.$dayNumber.'</>.');

        $this->io->section('Solving the day!');
        $this->io->text('Let me think for a minute...');
        $this->io->newLine();

        $puzzleOfTheDay = $this->puzzleLoader->getPuzzle($dayNumber);

        $this->io->text(
            'Solution for part one is: <fg=yellow;options=bold>'.
            $puzzleOfTheDay->solvePartOne().'</>'
        );
        $this->io->text(
            'Solution for part two is: <fg=yellow;options=bold>'.
            $puzzleOfTheDay->solvePartTwo().'</>'
        );

        $this->io->newLine();
        $this->io->text('Merry Xmas! <fg=green>:)</>');
        $this->io->newLine();

        return Command::SUCCESS;
    }

    private function getDayNumberToSolve(InputInterface $input, OutputInterface $output): int
    {
        $day = (int) $input->getArgument('day');
        if (!$this->validateDay($day)) {
            $day = $this->askForDay($input, $output);
        }

        return $day;
    }

    private function validateDay(int $day): bool
    {
        return $day > 0
            && $day <= $this->puzzleLoader->getAvailablePuzzleCount();
    }

    private function askForDay(InputInterface $input, OutputInterface $output): int
    {
        $choices = $this->puzzleLoader->getDaysListForChoice();

        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Which challenge should we solve ?',
            $choices
        );
        $question->setErrorMessage('I didn\'t quite hear you. Say again ?');

        $dayAnswer = $helper->ask($input, $output, $question);

        return array_search($dayAnswer, $choices); // Needed until https://github.com/symfony/symfony/issues/40439.
    }
}
