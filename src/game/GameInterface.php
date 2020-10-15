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
    public function chooseWhoStarts($hero, $beast);

    public function getProb($percentage);

    public function play($hero, $beast);
}
