<?php

require './vendor/autoload.php';

use App\gameChar\Orderus;
use App\gameChar\Beast;
use App\game\Game;
use App\Tester;

/**
 * App entry point  
 *
 * @author  Dragos
 * @license MIT 
 */

$orderus = new Orderus();

$beast = new Beast();

$game = new Game();

$game->play($orderus, $beast);


//tests
// $test = new Tester();
// $test->checkIfInstanceIsOfTypeCharacter($orderus);
// $test->checkIfInstanceIsOfTypeCharacter($beast);
// $test->checkIfIsOfTypeGame($game);
// $test->checkIfGameIsPlayable($game);
// $test->testMethod('getProb', $game, 'boolean', 2);
// $test->testMethod('chooseWhoStarts', $game, 'string', $orderus, $beast);
