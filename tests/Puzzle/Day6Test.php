<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day6Test extends PuzzleTestCase
{
    #[\Override]
    protected function getDayNumber(): int
    {
        return 6;
    }

    #[\Override]
    protected function getExpectedPartOne(): int
    {
        return 288;
    }

    #[\Override]
    protected function getExpectedPartTwo(): int
    {
        return 71503;
    }
}
