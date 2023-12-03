# Advent of Code - 2023

Another year, another [AdventOfCode](https://adventofcode.com/2023) :-)

This time, let's play with Symfony's [Console component](https://symfony.com/doc/current/components/console.html).

## Solve it all!

This requires PHP ^8.3 and Composer.

```shell
# Install dependencies.
composer install

# Enjoy the ride!
./advent
```

## Tests

```shell
composer test
```

## New day ?

All boilerplate is handled:
1. Create new class `Advent2023\Puzzle\Day1` extending `Advent2023\Puzzle\PuzzleSolver`.
2. Create new input text file in "./data/Puzzle1" with level input.

Progress by testing:

3. Create new test class `Advent2023\Tests\Puzzle\Day1Test` extending `Advent2023\Tests\Puzzle\PuzzleTestCase`.
4. Create new input text file in "./tests/Puzzle/Input/Puzzle1" with test input.

## Bonus

See my other modest attempts:
- [AoC 2020](https://github.com/MeroveeCharrue/adventofcode-2020)
- [AoC 2019](https://github.com/MeroveeCharrue/adventofcode)
