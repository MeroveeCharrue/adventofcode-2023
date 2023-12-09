<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day6 extends PuzzleSolver
{
    #[\Override]
    public function solvePartOne(): int
    {
        $records = [];
        foreach ($this->lines as $i => $line) {
            $values = explode(':', $line);
            preg_match_all('/\d+/', $values[1], $numbers);
            foreach ($numbers[0] as $entry => $number) {
                $records[$entry][$i] = $number;
            }
        }

        $winsProduct = 1;
        foreach ($records as $record) {
            $wins = $this->computeWinningOptions($record);
            $winsProduct *= $wins;
        }

        return $winsProduct;
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        $record = [];
        foreach ($this->lines as $i => $line) {
            $values = explode(':', $line);
            preg_match_all('/\d+/', $values[1], $numbers);
            $record[$i] = implode('', $numbers[0]);
        }

        return $this->computeWinningOptions($record);
    }

    private function computeWinningOptions(array $raceRecord): int
    {
        [$time, $distanceToBeat] = $raceRecord;
        $winningsIntervalStart = 0;

        for ($speed = 1; $speed < $time/2; $speed++) {
            $distance = ($time - $speed) * $speed;
            if ($distance > $distanceToBeat) {
                $winningsIntervalStart = $speed;
                break;
            }
        }

        return $time - $winningsIntervalStart*2 + 1;
    }
}
