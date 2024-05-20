<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    public function testCreateCardHand()
    {
        $cardHand = new CardHand();

        $this->assertInstanceOf("\App\Card\CardHand", $cardHand);

    }

    public function testAdd()
    {
        $cardHand = new CardHand();
        for ($i = 0; $i < 7; $i++) {
            $card = new Card();
            $card->setSuit();
            $card->setValue();
            $card->setPrint();
            $cardHand-> add($card);

        }
        $this->assertNotEmpty($cardHand);

        //test arrays
        $stringArray = $cardHand->getStringArray();
        $this->assertNotEmpty($stringArray[20]);
        $printArray = $cardHand->getPrint();
        $this->assertNotEmpty($printArray[6]);
        $jsonArray = $cardHand->getJsonStringArray();
        $this->assertNotEmpty($jsonArray[6]);
    }

}
