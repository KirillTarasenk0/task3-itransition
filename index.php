<?php

require_once 'vendor/autoload.php';

function areAllElementsUnique(array $array): bool
{
    $uniqueArray = array_unique($array);
    return count($uniqueArray) === count($array);
}

array_shift($argv);
if (areAllElementsUnique($argv)) {
    if (count($argv) >= 3) {
        if (count($argv) % 2 !== 0) {
            print_r($argv);
        } else {
            echo 'You passed an even number of arguments. Please re-enter. Example: "rock Spock paper lizard scissors"';
        }
    } else {
        echo 'You passed the number of arguments less than 3. Please repeat your input. Example: "rock Spock paper lizard scissors"';
    }
} else {
    echo 'You passed arguments that included duplicate values. Please re-enter again. Example: “rock Spock paper lizard scissors.”';
}
