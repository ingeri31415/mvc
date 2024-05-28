<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDice()
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    public function testValueDice(){

        $die = new Dice();
        $value = $die->roll();

        $value2 = $die->getValue();
        $this->assertEquals($value, $value2);
        $this->assertGreaterThan(0, $value);
        $this->assertLessThan(7, $value);
        

    }

}
