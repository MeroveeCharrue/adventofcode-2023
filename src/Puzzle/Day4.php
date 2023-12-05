<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day4 extends PuzzleSolver
{
    #[\Override]
    public function solvePartOne(): int
    {
        $pointSum = 0;

        foreach ($this->lines as $line) {
            $matchCount = $this->getMatchCount($line);

            if ($matchCount) {
                $pointSum += pow(2, $matchCount - 1);
            }
        }

        return $pointSum;
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        return 0;
    }

    private function getMatchCount(string $game): int
    {
        $winningNumbers = [];
        $playedNumbers = [];
        $card = explode(':', $game);
        $draws = explode('|', $card[1]);
        preg_match_all('/\d+/', $draws[0], $winningNumbers);
        preg_match_all('/\d+/', $draws[1], $playedNumbers);

        return count(array_intersect($winningNumbers[0], $playedNumbers[0]));
    }
}
