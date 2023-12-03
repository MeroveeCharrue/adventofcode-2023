<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day1 extends PuzzleSolver
{
    #[\Override]
    public function solvePartOne(): int
    {
        $calibrationSum = 0;
        foreach ($this->lines as $line) {
            $firstDigit = null;
            $lastDigit = null;
            foreach (str_split($line) as $char) {
                if (is_numeric($char)) {
                    if (is_null($firstDigit)) {
                        $firstDigit = $char;
                    }
                    $lastDigit = $char;
                }
            }

            $calibrationSum += (int) ($firstDigit.$lastDigit);
        }

        return $calibrationSum;
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        $expectedDigits = [1 => 'one', 'two', 'three', 'four',
            'five', 'six', 'seven', 'eight', 'nine',
            '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        $calibrationSum = 0;
        foreach ($this->lines as $line) {
            $earliestPos = 999;
            $earliestDigit = '';
            $latestPos = -1;
            $latestDigit = '';
            foreach ($expectedDigits as $expectedDigit) {
                $earlyPos = strpos($line, $expectedDigit);
                $latePos = strrpos($line, $expectedDigit);

                if ($earlyPos !== false && $earlyPos < $earliestPos) {
                    $earliestPos = $earlyPos;
                    $earliestDigit = array_search($expectedDigit, $expectedDigits);
                    if ($earliestDigit > 9) {
                        $earliestDigit = $expectedDigit;
                    }
                }

                if ($latePos !== false && $latePos > $latestPos) {
                    $latestPos = $latePos;
                    $latestDigit = array_search($expectedDigit, $expectedDigits);
                    if ($latestDigit > 9) {
                        $latestDigit = $expectedDigit;
                    }
                }
            }

            $calibrationSum += (int) ($earliestDigit.$latestDigit);
        }

        return $calibrationSum;
    }
}
