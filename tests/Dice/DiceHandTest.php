<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceHandTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDiceHand()
    {
        $dieH = new DiceHand();
        $this->assertInstanceOf("\App\Dice\DiceHand", $dieH);
        $dieH->add(new Dice());
        $res = $dieH->getString();
        $this->assertNotEmpty($res);
        $this->assertEquals(1, $dieH->getNumberDices());
    }

    public function testValuesDiceHand()
    {
        $dieH = new DiceHand();
        $dieH->add(new Dice());
        $dieH->roll();
        $vals = $dieH->getValues();
        $this->assertNotEquals(0, $vals[0]);

    }


}
