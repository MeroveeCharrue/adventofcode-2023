<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day3 extends PuzzleSolver
{
    #[\Override]
    public function solvePartOne(): int
    {
        $enginePartNumberSum = 0;

        foreach ($this->lines as $i => $line) {
            foreach (str_split($line) as $j => $char) {
                if ($this->isSymbol($char)) {
                    $partValues = $this->captureSurroundingPartValues($i, $j);
                    foreach ($partValues as $partValue) {
                        $enginePartNumberSum += $partValue;
                    }
                }
            }
        }

        return $enginePartNumberSum;
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        $gearRatioSum = 0;

        foreach ($this->lines as $i => $line) {
            foreach (str_split($line) as $j => $char) {
                if ($this->mightBeGear($char)) {
                    $partValues = $this->captureSurroundingPartValues($i, $j);
                    if (count($partValues) === 2) {
                        $gearRatioSum += array_product($partValues);
                    }
                }
            }
        }

        return $gearRatioSum;
    }

    private function isSymbol(string $char): bool
    {
        return (bool) preg_match('/[^0-9.]/', $char);
    }

    private function mightBeGear(string $char): bool
    {
        return $char === '*';
    }

    private function captureSurroundingPartValues(int $row, int $column): array
    {
        $partValues = [];

        for ($i = $row-1; $i <= $row+1; $i++) {
            if ($i < 0 || $i >= count($this->lines)) {
                continue;
            }
            preg_match_all('/\d+/', $this->lines[$i], $matches, PREG_OFFSET_CAPTURE);

            foreach ($matches[0] as [$value, $offset]) {

                foreach (str_split($value) as $position => $digit) {
                    if (in_array((int)$offset + (int)$position, [$column-1, $column, $column+1])) {
                        $partValues[$i.$offset] = $value;
                    }
                }
            }
        }

        return $partValues;
    }
}
