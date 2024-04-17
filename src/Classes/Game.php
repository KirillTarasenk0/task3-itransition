<?php

namespace Itransition\Classes;

use Itransition\Traits\UniqueElements;
use Itransition\Classes\Table;

class Game
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
                    $this->computerMove = $this->generateComputerMove();
                    $this->key = KeyGenerator::generateKey();
                } else {
                    exit('You passed an even number of arguments. Please re-enter. Example: "rock Spock paper lizard scissors"' . PHP_EOL);
                }
            } else {
                exit('You passed the number of arguments less than 3. Please repeat your input. Example: "rock Spock paper lizard scissors"' . PHP_EOL);
            }
        } else {
            exit('You passed arguments that included duplicate values. Please re-enter again. Example: “rock Spock paper lizard scissors.”' . PHP_EOL);
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
        $previousIndexes = array_map(function($index) {
            return ($index === 0) ? count($this->moves) : $index;
        }, $previousIndexes);
        if (in_array($computerIndex, $nextIndexes)) {
            return 'Win';
        }
        if (in_array($computerIndex, $previousIndexes)) {
            return 'Lose';
        }
        return ($playerIndex === $computerIndex) ? 'Draw' : 'Win';
    }

    private function generateComputerMove(): int
    {
        $randomIndex = array_rand($this->moves);
        return (int)$randomIndex + 1;
    }
    private function showHMAC(): void
    {
        echo 'HMAC: ' . HMACGenerator::generateHMAC($this->computerMove, $this->key) . PHP_EOL;
    }
    private function displayMenu(): void
    {
        echo 'Available moves:' . PHP_EOL;
        foreach ($this->moves as $index => $move) {
            echo $index + 1 . " - $move" . PHP_EOL;
        }
        echo '0 - exit' . PHP_EOL;
        echo '? - help' . PHP_EOL;
    }
    private function getUserMove()
    {
        $input = readline('Enter your move: ');
        if ($input == '?') {
            $this->displayHelp();
            return $this->getUserMove();
        } elseif (!is_numeric($input) || $input < 1 || $input > count($this->moves)) {
            echo 'Invalid move. Please try again' . PHP_EOL;
            return $this->getUserMove();
        } elseif ($input == 0) {
            exit('Thanks for the game! Bye!' . PHP_EOL);
        } else {
            $this->userMove = $input;
        }
    }
    private function displayHelp(): void
    {
        $table = new Table();
        $generatedTable = $table->generateTable($this, $this->moves);
        $table->displayTable($generatedTable);
    }
    public function play(): void
    {
        $this->showHMAC();
        $this->displayMenu();
        $this->getUserMove();
        echo 'Your move: ' . $this->userMove . PHP_EOL;
        echo 'Computer move: ' . $this->computerMove . PHP_EOL;
        $result = $this->determineWinner($this->userMove, $this->computerMove);
        echo 'Result: ' . $result . PHP_EOL;
        echo 'HMAC key: ' . $this->key . PHP_EOL;
    }
}