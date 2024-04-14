<?php

require_once 'vendor/autoload.php';

array_shift($argv);
if (count($argv) >= 3) {
    if (count($argv) % 2 !== 0) {
        print_r($argv);
    } else {
        echo 'You passed an even number of arguments. Please re-enter. Example: "rock Spock paper lizard scissors"';
    }
} else {
    echo 'You passed the number of arguments less than 3. Please repeat your input. Example: "rock Spock paper lizard scissors"';
}
