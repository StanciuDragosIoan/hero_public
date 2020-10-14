<?php /* src/game/GameInterface.php */

namespace App\game;

/**
 * Game Interface
 *
 * @author  Dragos
 * @license MIT 
 */
interface GameInterface
{
    public function chooseWhoStarts();

    public function getProb();

    public function play();
}
