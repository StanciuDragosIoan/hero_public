<?php /* src/gameChar/Beast.php */



use src\gameChar\GameCharacter;
use src\gameChar\GameCharacterInterface;

namespace App\gameChar;


/**
 * The Magic Beast
 * 
 * inherits from GameCharacter and implements the GameCharacterInterface
 * 
 * @author  Dragos
 * @license MIT 
 */
class Beast
extends GameCharacter
implements GameCharacterInterface
{
    /**
     * Magic Beast title
     *
     * @var string
     */
    public $title;

    /**
     * Magic Beast health points
     *
     * @var integer
     */
    public $health;

    /**
     * Magic Beast strength points
     *
     * @var integer
     */
    public $strength;

    /**
     * Magic Beast defence points
     *
     * @var integer
     */
    public $defence;

    /**
     * Magic Beast speed points
     *
     * @var integer
     */
    public $speed;

    /**
     * Magic Beast luc points
     *
     * @var integer
     */
    public $luc;

    /**
     * Magic Beast last damage taken (it is set by the enemy)
     *
     * @var integer
     */
    public $latestDmg;

    /**
     * Magic Beast type (for testing)
     *
     * @var string
     */
    public $type;

    public function __construct()
    {
        $this->title = 'Magic Beast';
        $this->type = 'gameChar';
        $this->initializeStats();
    }

    /*
    * Sets the initial stats of the Magic Beast
    */
    public function initializeStats()
    {
        $this->health = rand(60, 90);
        $this->strength = rand(70, 80);
        $this->defence = rand(40, 60);
        $this->speed = rand(40, 50);
        $this->luc = rand(25, 40);
    }
}
