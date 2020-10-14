<?php  /* src/Tester.php */

namespace App;

/**
 * Testing Class
 *
 * @author  Dragos
 * @license MIT 
 */

class Tester
{

    /*
     * Check if instance is of type gameChar
     * Checks if we instantiate the right game character classes
     *
     * @param  $instance (the character instance)
     *
     * @return boolen
     */
    public function checkIfInstanceIsOfTypeCharacter($instance)
    {
        if ($instance->type === 'gameChar') {
            echo "\e[0;31;42m Test Passed Successfully $instance->title is of type $instance->type !\e[0m\n";
            return true;
        } else {
            echo "\e[0;41;41m Test Failed X_X $instance->title is of type $instance->type which is NOT gameChar !\e[0m\n";
            return false;
        }
    }


    /*
     * Check if instance is of type game
     * Checks if we can pass the 2 characters to the game class
     * 
     * @param  $gameInstance 
     *
     * @return boolen
     */
    public function checkIfIsOfTypeGame($gameInstance)
    {

        if (property_exists($gameInstance, 'attacker') && property_exists($gameInstance, 'defender')) {
            echo "\e[0;31;42m Test Passed Successfully the game instance can received an attacker type and a defender type with a type of" . $gameInstance->attacker->type . " !\e[0m\n";
            return true;
        } else {
            echo "\e[0;41;41m Test Failed X_X  the game instance CANNOT received an attacker type and a defender type with a type of" . $gameInstance->attacker->type .  "!\e[0m\n";
            return false;
        }
    }


    /*
     * Check if the game is playable 
     * 
     * @param  $gameInstance 
     *
     * @return boolen
     */
    public function checkIfGameIsPlayable($gameInstance)
    {
        if (method_exists($gameInstance, 'play')) {
            echo "\e[0;31;42m Test Passed Successfully the game  can be played as it has a play() method !\e[0m\n";
            return true;
        } else {
            echo "\e[0;41;41m Test Failed X_X  the game  CANNOT be played as it does NOT  have a  play() method !\e[0m\n";
            return false;
        }
    }



    /*
     * Tests methods
     * Tests whether methods return what they should be returning in the method definition
     * 
     * @param  $method (string with the method name)
     * 
     * @param $class (the class instance whose method we test)
     * 
     * @param $returnType (string with the return type)
     * 
     * @param $paramForMethodToTest (optional param for the method we test)
     * 
     * @param $secondParamFortest (second optional param for the method we test)
     *
     * @return boolen
     */
    public function testMethod($method, $class, $returnType, $paramForMethodToTest = null, $secondParamFortest = null)
    {
        $instance = new $class();
        if (method_exists($class, $method)) {
            $return = $instance->$method($paramForMethodToTest, $secondParamFortest);
            if (gettype($return) === $returnType) {
                echo "\e[0;31;42m Test Passed Successfully the instance of type $class->type has a method $method and returns a $returnType !\e[0m\n";
                return true;
            } else {
                echo "\e[0;41;41m Test Failed X_X the instance of type $class->type does NOT have a method $method and does NOT return a $returnType  !\e[0m\n";
                return false;
            }
        } else {
            echo "\e[0;41;41m Test Failed X_X the instance of type $class->type does NOT have a method $method and does NOT return a $returnType  !\e[0m\n";
            return false;
        }
    }
}
