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
        $seedsLine = explode(':', $this->lines[0]);
        preg_match_all('/\d+/', $seedsLine[1], $seeds);
        $seeds = $seeds[0];

        $seedIntervals = [];
        for ($i = 0; $i < count($seeds); $i += 2) {
            $seedIntervals[] = [$seeds[$i], $seeds[$i] + $seeds[$i+1] - 1];
        }
        $maps = $this->parseMaps();

        $inputIntervals = $seedIntervals;

        foreach ($maps as $map) {
            $forNextMapShifted = [];
            usort($inputIntervals, function($a, $b) { return $a[0] - $b[0]; });
            $loop = 0;
            while ($inputIntervals[$loop]) {
                usort($inputIntervals, function($a, $b) { return $a[0] - $b[0]; });
                $inputInterval = $inputIntervals[$loop];

                $forNextMap = [];
                foreach ($map as $mapInterval) {
                    if ($mapInterval->srcRight < $inputInterval[0] || $mapInterval->srcLeft > $inputInterval[1]) {
                        continue;
                    }

                    $shift = $mapInterval->destLeft - $mapInterval->srcLeft;
                    $newLeft = max($inputInterval[0], $mapInterval->srcLeft);
                    $newRight = min($inputInterval[1], $mapInterval->srcRight);

                    $forNextMap[] = [$newLeft, $newRight, $shift];
                }

                if (empty($forNextMap)) {
                    $forNextMap[] = [$inputInterval[0], $inputInterval[1], 0];
                }

                // Unmapped beginning or end of inputInterval.
                if ($forNextMap[count($forNextMap)-1][1] < $inputInterval[1]) {
                    $inputIntervals[] = [$forNextMap[count($forNextMap)-1][1] + 1, $inputInterval[1]];
                }
                if ($forNextMap[0][0] > $inputInterval[0]) {
                    $inputIntervals[] = [$inputInterval[0], $forNextMap[0][0] - 1];
                }

                // Compute shifts.
                foreach ($forNextMap as $fnm) {
                    $forNextMapShifted[] = [$fnm[0] + $fnm[2], $fnm[1] + $fnm[2]];
                }

                $loop++;
            }
            $inputIntervals = $forNextMapShifted;
        }

        return min($inputIntervals)[0];
    }

    private function applyMap(array $map, int $value): int
    {
        foreach ($map as $sliceInterval) {
            if ($value >= $sliceInterval->srcLeft && $value <= $sliceInterval->srcRight) {
                $value += ($sliceInterval->destLeft - $sliceInterval->srcLeft);
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

        $objectifiedLines = array_map(fn(string $line): object =>
            preg_match_all('/\d+/', $line, $values) ?
                (object) [
                    'srcLeft' => $values[0][1],
                    'srcRight' => $values[0][1] + $values[0][2] - 1,
                    'destLeft' => $values[0][0],
                    'destRight' => $values[0][0] + $values[0][2] - 1,
                ] : (object)[],
            $mapLines
        );
        usort($objectifiedLines, function($a, $b) { return $a->srcLeft - $b->srcLeft; });

        return $objectifiedLines;
    }
}
