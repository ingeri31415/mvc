<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    public function testCreateCardGraphic()
    {
        $card = new CardGraphic();

        $this->assertInstanceOf("\App\Card\CardGraphic", $card);

    }
    public function testPrintCardGraphic()
    {
        $card2 = new CardGraphic();

        $card2->detValue(0);
        $card2->detSuit(0);

        // $val = $card2->detValue(0);
        // $suit = $card2->detSuit(0);
        $card2->setPrint();

        $cardPrint = $card2->getPrint();


        $this->assertEquals('🂡', $cardPrint[0]);
    }

}
