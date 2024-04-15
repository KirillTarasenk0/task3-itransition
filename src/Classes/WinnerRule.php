<?php

namespace Itransition\Classes;

class WinnerRule
{
    public function __construct(
        private array $movies,
    ) {}
    public function determineWinner(int $playerIndex, int $computerIndex): string
    {
        $half = floor(count($this->movies) / 2);
        $nextIndexes = [];
        $previousIndexes = [];
        for ($i = 1; $i <= $half; $i++) {
            $nextIndexes[] = ($playerIndex + $i) % count($this->movies);
            $previousIndexes[] = ($playerIndex - $i + count($this->movies)) % count($this->movies);
        }
        $previousIndexesLength = count($previousIndexes);
        for ($i = 0; $i < $previousIndexesLength; $i++) {
            if ($previousIndexes[$i] === 0) {
                $previousIndexes[$i] = end($this->movies);
            }
        }
        if (in_array($computerIndex, $nextIndexes)) return 'Win';
        if (in_array($computerIndex, $previousIndexes)) return 'Lose';
        return 'Draw';
    }
}