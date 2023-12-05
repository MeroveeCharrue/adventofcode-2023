<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day4Test extends PuzzleTestCase
{
    #[\Override] protected function getDayNumber(): int
    {
        return 4;
    }

    #[\Override] protected function getExpectedPartOne(): int
    {
        return 13;
    }

    #[\Override] protected function getExpectedPartTwo(): int
    {
        return 30;
    }
}
