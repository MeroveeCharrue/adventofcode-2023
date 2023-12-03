<?php

declare(strict_types=1);

namespace Advent2023\Repository;

use Advent2023\Puzzle\PuzzleSolver;
use Symfony\Component\Finder\Finder;

class PuzzleLoader
{
    /** @var string[] $dayFilenames */
    private array $dayFilenames;

    public function __construct()
    {
        $finder = new Finder();
        $finder->files()
            ->in(dirname(__DIR__).'/Puzzle')
            ->name('Day*.php')
            ->sortByCaseInsensitiveName();

        $i = 1;
        foreach ($finder as $file) {
            $this->dayFilenames[$i++] = $file->getFilenameWithoutExtension();
        }
    }

    public function getDaysListForChoice(): array
    {
        return $this->dayFilenames;
    }

    public function getAvailablePuzzleCount(): int
    {
        return count($this->dayFilenames);
    }

    public function getPuzzle(int $dayNumber): PuzzleSolver
    {
        $fqcn = 'Advent2023\Puzzle\\'.$this->dayFilenames[$dayNumber];

        return new $fqcn($dayNumber);
    }
}
