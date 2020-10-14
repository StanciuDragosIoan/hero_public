<?php /* src/gameChar/Orderus.php */

use App\game\Game;
use App\game\GameInterface;

namespace App\gameChar;




/**
 * Orderus the hero
 * 
 * inherits from GameCharacter and implements the GameCharacterInterface
 * 
 * @author  Dragos
 * @license MIT 
 */
class Orderus
extends GameCharacter
implements GameCharacterInterface
{
    /**
     * Orderus title
     *
     * @var string
     */
    public $title;

    /**
     * Orderus health points
     *
     * @var integer
     */
    public $health;

    /**
     * Orderus strength points
     *
     * @var integer
     */
    public $strength;

    /**
     * Orderus defence points
     *
     * @var integer
     */
    public $defence;

    /**
     * Orderus speed points
     *
     * @var integer
     */
    public $speed;

    /**
     * Orderus luc points
     *
     * @var integer
     */
    public $luc;

    /**
     * Orderus last damage taken (it is set by the enemy)
     *
     * @var integer
     */
    public $latestDmg;

    /**
     * Orderus type (for testing)
     *
     * @var string
     */
    public $type;

    public function __construct()
    {
        $this->title = 'Orderus';
        $this->type = 'gameChar';
        $this->initializeStats();
    }



    /*
    * Sets the initial stats of Orderus
    */
    public function initializeStats()
    {
        $this->health = rand(70, 100);
        $this->strength = rand(70, 80);
        $this->defence = rand(45, 55);
        $this->speed = rand(40, 50);
        $this->luc = rand(10, 30);
    }

    /*
    * Rapid Strike
    * Orderus hits 2x damage
    *
    * @param  $enemy
    *
    */
    public function rapidStrike($enemy)
    {
        echo "\n RAPID_STRIKE Orderus deals 2 X damage! \n";
        echo "\n $enemy->title has $enemy->health ' s HP before attack: \n";
        echo " \n $this->title attacks $enemy->title and deals damage of " . (2 * ((int)$this->strength - (int)$enemy->defence)) . "\n";
        (int)$enemy->health -= (2 * ((int)$this->strength - (int)$enemy->defence));
        echo "\n $enemy->title has $enemy->health HP after receiving attack: \n";
    }

    /*
    * Magic Shield
    * Orderus receives only half damage when hit
    *
    * @param  $enemy
    *
    */
    public function magicShield($enemy)
    {
        echo "\n $this->title has $this->health ' s HP before magic shield: \n";
        echo "\n MAGIC_SHIELD Orderus receives only half damage!\n";
        $this->health += round((int)$this->latestDmg / 2);
        echo "\n $this->title has restored " . round((int)$this->latestDmg / 2) . " HP and currently $this->health HP: \n";
    }
}
