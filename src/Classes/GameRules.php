<?php

namespace Itransition\Classes;

use Itransition\Traits\UniqueElements;

class GameRules
{
    use UniqueElements;
    private array $movies;
    public function __construct(array $movies)
    {
        array_shift($movies);
        if ($this->areAllElementsUnique($movies)) {
            if (count($movies) >= 3) {
                if (count($movies) % 2 !== 0) {
                    $this->movies = $movies;
                    /*$winnerRule = new GameRules($argv);
                    echo $winnerRule->determineWinner(1, 0);*/
                } else {
                    echo 'You passed an even number of arguments. Please re-enter. Example: "rock Spock paper lizard scissors"';
                }
            } else {
                echo 'You passed the number of arguments less than 3. Please repeat your input. Example: "rock Spock paper lizard scissors"';
            }
        } else {
            echo 'You passed arguments that included duplicate values. Please re-enter again. Example: “rock Spock paper lizard scissors.”';
        }
    }
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