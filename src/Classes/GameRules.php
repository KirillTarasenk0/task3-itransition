<?php

namespace Itransition\Classes;

use Itransition\Traits\UniqueElements;
use Itransition\Classes\KeyGenerator;

class GameRules
{
    use UniqueElements;
    private array $moves;
    private int $computerMove;
    private int $userMove;
    private string $key;
    public function __construct(array $moves)
    {
        array_shift($moves);
        if ($this->areAllElementsUnique($moves)) {
            if (count($moves) >= 3) {
                if (count($moves) % 2 !== 0) {
                    $this->moves = $moves;
                    $this->computerMove = $this->generateComputerMovie();
                    $this->key = KeyGenerator::generateKey();
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
        $half = floor(count($this->moves) / 2);
        $nextIndexes = [];
        $previousIndexes = [];
        for ($i = 1; $i <= $half; $i++) {
            $nextIndexes[] = ($playerIndex + $i) % count($this->moves);
            $previousIndexes[] = ($playerIndex - $i + count($this->moves)) % count($this->moves);
        }
        $previousIndexesLength = count($previousIndexes);
        for ($i = 0; $i < $previousIndexesLength; $i++) {
            if ($previousIndexes[$i] === 0) {
                $previousIndexes[$i] = end($this->moves);
            }
        }
        if (in_array($computerIndex, $nextIndexes)) return 'Win';
        if (in_array($computerIndex, $previousIndexes)) return 'Lose';
        return 'Draw';
    }
    private function generateComputerMovie(): int
    {
        return $this->moves[rand(0, count($this->moves) - 1)];
    }
}