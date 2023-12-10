<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day7Test extends PuzzleTestCase
{
    #[\Override]
    protected function getDayNumber(): int
    {
        return 7;
    }

    #[\Override]
    protected function getExpectedPartOne(): int
    {
        return 6440;
    }

    #[\Override]
    protected function getExpectedPartTwo(): int
    {
        return 5905;
    }
}
