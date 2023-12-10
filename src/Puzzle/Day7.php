<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day7 extends PuzzleSolver
{
    private const array CARDS = [2,3,4,5,6,7,8,9,'T','J','Q','K','A'];
    private const array CARDS_P2 = ['J',2,3,4,5,6,7,8,9,'T','Q','K','A'];

    #[\Override]
    public function solvePartOne(): int
    {
        $fives = [];
        $fours = [];
        $fulls = [];
        $threes = [];
        $twoPairs = [];
        $pairs = [];
        $bratla = [];

        foreach ($this->lines as $line) {
            $hand = explode(' ', $line);

            $cards = str_split($hand[0]);
            $cardCount = [];
            foreach ($cards as $card) {
                isset($cardCount[$card]) ? $cardCount[$card]++ : $cardCount[$card] = 1;
            }
            rsort($cardCount);
            switch ($cardCount[0]) {
                case 5:
                    $fives[] = $hand;
                    break;
                case 4:
                    $fours[] = $hand;
                    break;
                case 3:
                    if ($cardCount[1] === 2) {
                        $fulls[] = $hand;
                    } else {
                        $threes[] = $hand;
                    }
                    break;
                case 2:
                    if ($cardCount[1] === 2) {
                        $twoPairs[] = $hand;
                    } else {
                        $pairs[] = $hand;
                    }
                    break;
                default:
                    $bratla[] = $hand;
            }
        }
        usort($bratla, [$this, 'sortHands']);
        usort($pairs, [$this, 'sortHands']);
        usort($twoPairs, [$this, 'sortHands']);
        usort($threes, [$this, 'sortHands']);
        usort($fulls, [$this, 'sortHands']);
        usort($fours, [$this, 'sortHands']);
        usort($fives, [$this, 'sortHands']);

        $results = array_merge($bratla, $pairs, $twoPairs, $threes, $fulls, $fours, $fives);
        $totalWinnings = 0;
        foreach ($results as $i => $result) {
            $totalWinnings += $result[1] * ($i+1);
        }

        return $totalWinnings;
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        $fives = [];
        $fours = [];
        $fulls = [];
        $threes = [];
        $twoPairs = [];
        $pairs = [];
        $bratla = [];

        foreach ($this->lines as $line) {
            $hand = explode(' ', $line);

            $cards = str_split($hand[0]);
            $cardCount = [];
            $jokerCount = 0;
            foreach ($cards as $card) {
                if ($card === 'J') {
                    $jokerCount++;
                } else {
                    isset($cardCount[$card]) ? $cardCount[$card]++ : $cardCount[$card] = 1;
                }
            }
            if (empty($cardCount)) {
                $cardCount[0] = $jokerCount;
            } else {
                rsort($cardCount);
                $cardCount[0] += $jokerCount;
            }
            switch ($cardCount[0]) {
                case 5:
                    $fives[] = $hand;
                    break;
                case 4:
                    $fours[] = $hand;
                    break;
                case 3:
                    if ($cardCount[1] === 2) {
                        $fulls[] = $hand;
                    } else {
                        $threes[] = $hand;
                    }
                    break;
                case 2:
                    if ($cardCount[1] === 2) {
                        $twoPairs[] = $hand;
                    } else {
                        $pairs[] = $hand;
                    }
                    break;
                default:
                    $bratla[] = $hand;
            }
        }
        usort($bratla, [$this, 'sortHandsPart2']);
        usort($pairs, [$this, 'sortHandsPart2']);
        usort($twoPairs, [$this, 'sortHandsPart2']);
        usort($threes, [$this, 'sortHandsPart2']);
        usort($fulls, [$this, 'sortHandsPart2']);
        usort($fours, [$this, 'sortHandsPart2']);
        usort($fives, [$this, 'sortHandsPart2']);

        $results = array_merge($bratla, $pairs, $twoPairs, $threes, $fulls, $fours, $fives);
        $totalWinnings = 0;
        foreach ($results as $i => $result) {
            $totalWinnings += $result[1] * ($i+1);
        }

        return $totalWinnings;
    }

    private function sortHands($a, $b, $i = 0): int
    {
        $keyA = array_search($a[0][$i], self::CARDS);
        $keyB = array_search($b[0][$i], self::CARDS);
        if ($keyA === $keyB) {
            return $this->sortHands($a, $b, ++$i);
        }
        return $keyA - $keyB;
    }

    private function sortHandsPart2($a, $b, $i = 0): int
    {
        $keyA = array_search($a[0][$i], self::CARDS_P2);
        $keyB = array_search($b[0][$i], self::CARDS_P2);
        if ($keyA === $keyB) {
            return $this->sortHandsPart2($a, $b, ++$i);
        }
        return $keyA - $keyB;
    }
}
