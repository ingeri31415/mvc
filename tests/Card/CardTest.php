<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCard()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);
        $card->setValue();
        $card->setSuit();
        $card->setPrint();
        $cardprint = $card->getPrint();
        $this->assertNotEmpty($cardprint);

        $card2 = new Card();
        $val = $card2->detValue(0);
        $suit = $card2->detSuit(0);
        $card2->setPrint();
        //$cardprint2 = $card2->getPrint();

        $val2 = $card2->getValue();
        $suit2 = $card2->getSuit();
        //$suitIndex = $card2->getSuitIndex();
        //$stringValue = $card2->getValueAsString();



        $this->assertEquals('A', $val);
        $this->assertEquals('♠', $suit);
        $this->assertEquals('♠', $suit2);


        $this->assertEquals('A', $card2->getValueAsString());



        $this->assertEquals(0, $val2);
        //$this->assertEquals(0, $suit);
        for ($i = 0; $i < 4; $i++) {
            $card3 = new Card();
            $card3->detSuit($i);
            $this->assertEquals($i, $card3->getSuitIndex());
        }



        //$this->assertEquals('🂡', $cardprint2[0]);

    }
}
