<?php

declare(strict_types=1);

namespace Advent2023\Tests\Puzzle;

use Advent2023\Puzzle\PuzzleSolver;
use PHPUnit\Framework\TestCase;

abstract class PuzzleTestCase extends TestCase
{
    private PuzzleSolver $solver;

    protected function setUp(): void
    {
        $fqcn = 'Advent2023\Puzzle\Day'.$this->getDayNumber();
        $this->solver = new $fqcn($this->getDayNumber(), true);
    }

    public function testPartOne(): void
    {
        $this->assertEquals(
            $this->getExpectedPartOne(),
            $this->solver->solvePartOne()
        );
    }

    public function testPartTwo(): void
    {
        $this->assertEquals(
            $this->getExpectedPartTwo(),
            $this->solver->solvePartTwo()
        );
    }

    abstract protected function getDayNumber(): int;
    abstract protected function getExpectedPartOne(): int;
    abstract protected function getExpectedPartTwo(): int;
}
