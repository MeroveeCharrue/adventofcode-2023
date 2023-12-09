<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day5Test extends PuzzleTestCase
{
    #[\Override]
    protected function getDayNumber(): int
    {
        return 5;
    }

    #[\Override]
    protected function getExpectedPartOne(): int
    {
        return 35;
    }

    #[\Override]
    protected function getExpectedPartTwo(): int
    {
        return 46;
    }
}
