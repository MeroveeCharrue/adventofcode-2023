<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day2 extends PuzzleSolver
{
    #[\Override]
    public function solvePartOne(): int
    {
        $maxRedCubes = 12;
        $maxGreenCubes = 13;
        $maxBlueCubes = 14;
        $idSum = 0;

        foreach ($this->lines as $id => $line) {
            $isThisLinePossible = true;
            $game = explode(': ', $line);
            $draws = explode('; ', $game[1]);
            foreach ($draws as $draw) {
                $colors = explode(', ', $draw);
                foreach ($colors as $colorString) {
                    [$colorCount, $colorName] = explode(' ', $colorString);
                    if ($colorName === 'red' && $colorCount > $maxRedCubes) {
                        $isThisLinePossible = false;
                    }
                    if ($colorName === 'green' && $colorCount > $maxGreenCubes) {
                        $isThisLinePossible = false;
                    }
                    if ($colorName === 'blue' && $colorCount > $maxBlueCubes) {
                        $isThisLinePossible = false;
                    }
                }
            }

            if ($isThisLinePossible) {
                $idSum += ($id+1);
            }
        }

        return $idSum;
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        $powerSum = 0;

        foreach ($this->lines as $line) {
            $game = explode(': ', $line);
            $draws = explode('; ', $game[1]);

            $maxRed = 0;
            $maxGreen = 0;
            $maxBlue = 0;

            foreach ($draws as $draw) {
                $colors = explode(', ', $draw);
                foreach ($colors as $colorString) {
                    [$colorCount, $colorName] = explode(' ', $colorString);
                    if ($colorName === 'red' && $colorCount > $maxRed) {
                        $maxRed = $colorCount;
                    }
                    if ($colorName === 'green' && $colorCount > $maxGreen) {
                        $maxGreen = $colorCount;
                    }
                    if ($colorName === 'blue' && $colorCount > $maxBlue) {
                        $maxBlue = $colorCount;
                    }
                }
            }

            $powerSum += ($maxRed * $maxGreen * $maxBlue);
        }

        return $powerSum;
    }
}
