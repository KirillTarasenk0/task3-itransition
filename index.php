<?php

require_once 'vendor/autoload.php';

use Itransition\Classes\GameRules;

$game = new GameRules($argv);
$game->play();