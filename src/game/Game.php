<?php /* src/game/Game.php */

namespace App\game;

/**
 * The game class (uses the 2 characters to 'play' the game)
 *
 * @author  Dragos
 * @license MIT 
 */

class Game implements GameInterface
{
    /**
     * attacker character
     *
     * @var character
     */
    public $attacker;

    /**
     * defender character
     *
     * @var character
     */
    public $defender;

    /**
     * type
     *
     * @var string
     */
    public $type = 'game';

    /*
    * Chooses who starts
    * Calculates which character attacks first based on their speed or luc stats
    *
    * @param  $hero this is Orderus =)
    * @param  $hero this is the Beast T_T
    *
    * @return  a string with the starter character 
    */
    public function chooseWhoStarts($hero, $beast)
    {
        if ($hero->speed > $beast->speed) {
            return 'hero';
        } else if ($hero->speed < $beast->speed) {
            return 'beast';
        } else if ($hero->speed === $beast->speed) {
            if ($hero->luc > $beast->luc) {
                return 'hero';
            } else {
                return 'beast';
            }
        }
    }

    /*
     * Calculates the probability for something
     * Used to determine whether to trigger a special skill
     * like magicShield or rapidStrike
     * 
     * @param $percentage (a number with the percentage required to trigger the skill)
     * 
     * @return true or false
     */
    public function getProb($percentage)
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
     * 'Plays the actual game'
     *  chooses who is the first character to start and runs the iterations
     *  for each attack
     * 
     *  calls getProb() and triggers the special skills if needed
     *  
     *  decides the victor based on the characters' remaining HP
     *  
     *  @param  $hero this is Orderus =)
     *  @param  $hero this is the Beast T_T
     */
    function play($hero, $beast)
    {
        $starterChar = $this->chooseWhoStarts($hero, $beast);
        if ($starterChar === 'hero') {
            echo "\n Hero starts \n";
            $this->attacker = $hero;
            $this->defender = $beast;
            var_dump("\n " . $this->attacker->title . ' HP :' . $this->attacker->health);
            var_dump("\n " . $this->defender->title . ' HP :' . $this->defender->health);
        } else {
            echo "\n Beast Starts \n";
            $this->attacker = $beast;
            $this->defender = $hero;
            var_dump("\n " . $this->attacker->title . ' HP :' . $this->attacker->health);
            var_dump("\n " . $this->defender->title . ' HP :' . $this->defender->health);
        }

        //game loop (max 20 iterations)
        for ($x = 0; $x <= 19; $x++) {
            var_dump("\n Round: " . ((int)$x + 1) . "! \n");
            //reinitialize luc before every attack to see who's 'Lucky'
            $this->attacker->reinitializeLuc($this->attacker->title);
            $this->defender->reinitializeLuc($this->defender->title);

            if ($this->getProb(10) === true) {
                if ($this->attacker->title === 'Orderus') {
                    $this->attacker->rapidStrike($this->defender);
                    $this->defender->attack($this->attacker);
                } else {
                    $this->attacker->attack($this->defender);
                    $this->defender->rapidStrike($this->attacker);
                }
            } else if ($this->getProb(20) === true) {
                if ($this->attacker->title === 'Orderus') {
                    $this->attacker->attack($this->defender);
                    $this->defender->attack($this->attacker);
                    $this->attacker->magicShield($this->defender);
                } else {
                    $this->attacker->attack($this->defender);
                    $this->defender->attack($this->attacker);
                    $this->defender->magicShield($this->attacker);
                }
            } else {

                if ($this->defender->isLuckier($this->attacker)) {
                    $this->attacker->miss($this->defender);
                    $this->defender->attack($this->attacker);
                } else if ($this->attacker->isLuckier($this->defender) === true) {
                    $this->defender->miss($this->attacker);
                    $this->attacker->attack($this->defender);
                }
            }

            //check remaining HP and if it reaches 0, end the game
            if ($this->attacker->health <= 0 && (int)$this->attacker->health < $this->defender->health) {
                echo "\n" . $this->defender->title . " won \n";
                echo "\n left health:" . $this->defender->title . " : " . $this->defender->health . "\n";
                echo "\n left health enemy:" .  $this->attacker->title . $this->attacker->health . "\n";
                die();
            } else if ($this->defender->health <= 0 && (int)$this->defender->health < $this->attacker->health) {
                echo "\n" . $this->attacker->title . " won \n";
                echo "\n left health:" . $this->attacker->title . " : " . $this->attacker->health . "\n";
                echo "\n left health enemy:" . $this->defender->title . $this->defender->health . "\n";
                die();
            }
        }
    }
}
