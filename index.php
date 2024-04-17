<?php

require_once 'vendor/autoload.php';

use Itransition\Classes\GameRules;

$game = new GameRules(array_slice($argv, 1));
$game->play();