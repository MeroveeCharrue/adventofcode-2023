<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

abstract class PuzzleSolver
{
    /** @var string[] $lines */
    protected array $lines;

    public function __construct(
        int $puzzleNumber,
        bool $testScenario = false
    ) {
        $path = './data/Puzzle'.$puzzleNumber;
        if ($testScenario) {
            $path = './tests/Puzzle/Input/Puzzle'.$puzzleNumber;
        }

        $fileContent = file_get_contents($path);
        $this->lines = explode(PHP_EOL, $fileContent);
        array_pop($this->lines); // remove last empty newline.
    }

    abstract public function solvePartOne(): int;
    abstract public function solvePartTwo(): int;
}
