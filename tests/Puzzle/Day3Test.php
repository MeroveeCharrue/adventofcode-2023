<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day3Test extends PuzzleTestCase
{
    #[\Override] protected function getDayNumber(): int
    {
        return 3;
    }

    #[\Override] protected function getExpectedPartOne(): int
    {
        return 4361;
    }

    #[\Override] protected function getExpectedPartTwo(): int
    {
        return 0;
    }
}
