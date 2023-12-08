<?php

declare(strict_types=1);

namespace Advent2023\Puzzle;

class Day5 extends PuzzleSolver
{
    #[\Override]
    public function solvePartOne(): int
    {
        $seedsLine = explode(':', $this->lines[0]);
        preg_match_all('/\d+/', $seedsLine[1], $mappedLocation);
        $mappedLocation = $mappedLocation[0];

        $maps = $this->parseMaps();
        foreach ($mappedLocation as $i => $seed) {
            foreach ($maps as $map) {
                $mappedLocation[$i] = $this->applyMap($map, (int) $mappedLocation[$i]);
            }
        }

        return (int) min($mappedLocation);
    }

    #[\Override]
    public function solvePartTwo(): int
    {
        return 0;
    }

    private function applyMap(array $map, int $value) {
        foreach ($map as $slice) {
            if ($value >= $slice[1] && $value < ($slice[1] + $slice[2])) {
                $value -= ($slice[1] - $slice[0]);
                break;
            }
        }

        return $value;
    }

    private function parseMaps(): array
    {
        $startSeed2Soil = array_search('seed-to-soil map:', $this->lines);
        $startSoil2Ferti = array_search('soil-to-fertilizer map:', $this->lines);
        $startFerti2Water = array_search('fertilizer-to-water map:', $this->lines);
        $startWater2Light = array_search('water-to-light map:', $this->lines);
        $startLight2Temp = array_search('light-to-temperature map:', $this->lines);
        $startTemp2Humid = array_search('temperature-to-humidity map:', $this->lines);
        $startHumid2Loc = array_search('humidity-to-location map:', $this->lines);

        $maps[] = $this->parseMap($startSeed2Soil+1, $startSoil2Ferti-1);
        $maps[] = $this->parseMap($startSoil2Ferti+1, $startFerti2Water-1);
        $maps[] = $this->parseMap($startFerti2Water+1, $startWater2Light-1);
        $maps[] = $this->parseMap($startWater2Light+1, $startLight2Temp-1);
        $maps[] = $this->parseMap($startLight2Temp+1, $startTemp2Humid-1);
        $maps[] = $this->parseMap($startTemp2Humid+1, $startHumid2Loc-1);
        $maps[] = $this->parseMap($startHumid2Loc+1, count($this->lines));

        return $maps;
    }

    private function parseMap(int $start, int $end): array
    {
        $mapLines = array_slice($this->lines, $start, $end - $start);

        return array_map(fn(string $line): array =>
            preg_match_all('/\d+/', $line, $values) ? $values[0] : [],
            $mapLines
        );
    }
}
