<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day1Test extends PuzzleTestCase
{
    #[\Override]
    protected function getDayNumber(): int
    {
        return 1;
    }

    #[\Override]
    protected function getExpectedPartOne(): int
    {
        return 209;
    }

    #[\Override]
    protected function getExpectedPartTwo(): int
    {
        return 281;
    }
}
