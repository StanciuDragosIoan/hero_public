<?php

//hero orderus
$hero = [
    'title' => 'hero',
    'hp' => rand(70, 100),
    'str' => rand(70, 80),
    'def' => rand(45, 55),
    'sp' => rand(40, 50),
    'luc' => rand(10, 30)
];

//mage or beast w/e statuses matter
$mage = [
    'title' => 'mage',
    'hp' => rand(60, 90),
    'str' => rand(60, 90),
    'def' => rand(40, 60),
    'sp' => rand(40, 60),
    'luc' => rand(25, 40)
];

/*
 * Chooses who starts
 */
function chooseWhoStarts($hero, $mage)
{
    if ($hero['sp'] > $mage['sp']) {
        return 'hero';
    } else if ($hero['sp'] < $mage['sp']) {
        return 'mage';
    } else if ($hero['sp'] === $mage['sp']) {
        if ($hero['luc'] > $mage['luc']) {
            return 'hero';
        } else {
            return 'mage';
        }
    }
}

/*
 * Calculates probability for magic shield and rapid strike
 */
function getProb($percentage)
{
    $max = 100 / $percentage;
    var_dump(round($max));
    $output = rand(1, round($max));
    if ($output === 1) {
        return true;
    } else {
        return false;
    }
}

/*
 * Calculates which player is luckier
 */
function isLuckier($v1, $v2)
{
    if ($v1 > $v2) {
        return true;
    } else if ($v1 === $v2) {
        $hero['luc'] = rand(10, 30);
        $mage['luc'] = rand(25, 40);
        isLuckier($hero['luc'], $mage['luc']);
    } else {
        return false;
    }
}


/*
 * Runs the alternative attacks between players
 */
function attack($p1, $p2)
{
    for ($x = 0; $x <= 20; $x++) {

        if ($p1['title'] === "hero") {
            $p1['luc'] = rand(10, 30);
            $p2['luc'] = rand(25, 40);
            $heroIsLuckier = isLuckier($p1['luc'], $p2['luc']);
            if (getProb(10) === true) {
                echo "\n RAPID STRIKE hERE p1 hero..";
                $p1['hp'] = (int)$p1['hp'] - (((int)$p2['str'] - (int)$p1['def']) * 2);
                $p2['hp'] = (int)$p2['hp'] - ((int)$p1['str'] - (int)$p2['def']);
            } else if (getProb(20) === true) {
                echo "\n MAGIC SHIELD hERE p1 hero..";
                $p1['hp'] = (int)$p1['hp'] - (2 / ((int)$p2['str'] - (int)$p1['def']));
                $p2['hp'] = (int)$p2['hp'] - ((int)$p1['str'] - (int)$p2['def']);
            } else if ($heroIsLuckier === true) {

                echo "\n HERO LUCKIER HERE hERE p1 hero..";
                $p1['hp'] = (int)$p1['hp'] - 0;
                $p2['hp'] = (int)$p2['hp'] - ((int)$p1['str'] - (int)$p2['def']);
            } else if ($heroIsLuckier === false) {
                echo "\n MAGE LUCKIER HERE hERE p2 mage..";
                $p1['hp'] = (int)$p1['hp'] - ((int)$p2['str'] - (int)$p1['def']);
                $p2['hp'] = (int)$p2['hp'] - 0;
            } else {
                $p1['hp'] = (int)$p1['hp'] - ((int)$p2['str'] - (int)$p1['def']);
                $p2['hp'] = (int)$p2['hp'] - ((int)$p1['str'] - (int)$p2['def']);
            }
        } else if ($p2['title'] === "hero") {
            $p2['luc'] = rand(10, 30);
            $p1['luc'] = rand(25, 40);
            $heroIsLuckier = isLuckier($p2['luc'], $p1['luc']);
            if (getProb(10) === true) {
                echo "\n RAPID STRIKE hERE  p2 hero..";
                $p1['hp'] = (int)$p1['hp'] - ((int)$p2['str'] - (int)$p1['def']);
                $p2['hp'] = (int)$p2['hp'] - (((int)$p1['str'] - (int)$p2['def']) * 2);
            } else if (getProb(20) === true) {
                echo "\n MAGIC SHIELD hERE p2 hero..";
                $p1['hp'] = (int)$p1['hp'] - ((int)$p2['str'] - (int)$p1['def']);
                $p2['hp'] = (int)$p2['hp'] - (2 / ((int)$p1['str'] - (int)$p2['def']));
            } else if ($heroIsLuckier === true) {
                echo "\n HERO LUCKIER HERE hERE p2 hero..";
                $p1['hp'] = (int)$p1['hp'] - ((int)$p2['str'] - (int)$p1['def']);
                $p2['hp'] = (int)$p2['hp'] - 0;
            } else if ($heroIsLuckier === false) {
                echo "\n MAGE LUCKIER HERE hERE p1 mage..";
                $p1['hp'] = (int)$p1['hp'] - 0;
                $p2['hp'] = (int)$p2['hp'] - ((int)$p1['str'] - (int)$p2['def']);
            } else {
                $p1['hp'] = (int)$p1['hp'] - ((int)$p2['str'] - (int)$p1['def']);
                $p2['hp'] = (int)$p2['hp'] - ((int)$p1['str'] - (int)$p2['def']);
            }
        }

        var_dump("\n " . $p2['title'] . "'s heath:" .  intval($p2['hp']));
        var_dump("\n" . $p1['title'] . "'s health:" . intval($p1['hp']));
        if ($p2['hp'] <= 0) {
            echo "\n fight ended!";
            var_dump($p2['hp']);
            echo "\niteration: $x";
            die("\n" . $p2['title'] . " died and" . " " .  $p1['title'] . " won!");
        } else if ($p1['hp'] <= 0) {
            echo "\n fight ended!";
            var_dump($p1['hp']);
            echo "\niteration: $x";
            die("\n" . $p1['title'] . " died and" . " " . $p2['title'] . " won!");
        }
    }
}


/*
 * Runs the whole game, calls all the other methods at some point
 */
function play($hero, $mage)
{
    $starter = chooseWhoStarts($mage, $hero);
    var_dump("mage's def: " . $mage['def']);
    var_dump("mage's initial HP: " . $mage['hp']);
    var_dump("mage's  atk: " . ((int)$mage['str'] - (int)$hero['def']));
    var_dump("hero's def: " . $hero['def']);
    var_dump("hero's initial HP: " . $hero['hp']);
    var_dump("hero's  atk: " . ((int)$hero['str'] - (int)$mage['def']));

    if ($starter === "mage") {
        echo "\n mage starts \n";

        attack($hero, $mage);
    } else if ($starter === "hero") {
        echo "\n hero starts \n ";


        attack($mage, $hero);
    }
}



play($hero, $mage);
