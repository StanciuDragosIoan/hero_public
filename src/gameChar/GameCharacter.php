<?php /* src/gameChar/GameCharacter.php */

namespace App\gameChar;

/**
 * Game Character Class
 *
 * @author  Dragos
 * @license MIT 
 */
class GameCharacter
{
    /*
    * Attack
    * Character attacks the enemy dealing damage for his STR points - enemy DEF
    *
    * @param  $enemy
    *
    */
    public function attack($enemy)
    {
        echo "\n $enemy->title has $enemy->health  HP before attack: \n";
        echo " \n $this->title attacks $enemy->title and deals damage of " . ((int)$this->strength - (int)$enemy->defence) . "\n";
        (int)$enemy->health -= (int)$this->strength - (int)$enemy->defence;
        $enemy->latestDmg = (int)$this->strength - (int)$enemy->defence;
        echo "\n $enemy->title has $enemy->health HP after receiving attack: \n";
    }

    /*
    * Miss
    * Character misses the enemy dealing  0
    *
    * @param  $enemy
    *
    */
    public function miss($enemy)
    {
        (int)$enemy->health -= 0;
        echo " \n " . $this->title . " missed to hit " . $enemy->title . " \n";
    }

    /*
    * Reinitialize Luc
    * Reinitializez the character's luc
    *
    * @param  string
    *
    */
    public function reInitializeLuc($title)
    {
        if ($title === 'Orderus') {
            $this->luc = rand(10, 30);
        } else if ($title === 'Magic Beast') {
            $this->luc = rand(25, 40);
        }
    }


    /*
      * isLuckier
      *
      * Checks if the enemy character has a higher luc
      *
      * @param  $enemy
      *
      * @return boolean
      */
    public function isLuckier($enemy)
    {
        if ((int)$this->luc >= (int)$enemy->luc) {
            return true;
        } else {
            return false;
        }
    }
}
