<?php

require_once 'vendor/autoload.php';

use Itransition\Classes\Game;

$game = new Game($argv);
$game->play();