<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

class Day2Test extends PuzzleTestCase
{

    #[\Override]
    protected function getDayNumber(): int
    {
        return 2;
    }

    #[\Override]
    protected function getExpectedPartOne(): int
    {
        return 8;
    }

    #[\Override]
    protected function getExpectedPartTwo(): int
    {
        return 2286;
    }
}
