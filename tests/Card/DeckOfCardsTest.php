<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckOfCards.
 */
class DeckOfCarTest extends TestCase
{
    public function testCreateDeckOfCard()
    {
        $deckOfCards = new DeckOfCards();

        $this->assertInstanceOf("\App\Card\DeckOfCards", $deckOfCards);

    }

    public function testNewDeckSorted()
    {
        $deck = new DeckOfCards();
        for ($i = 0; $i < 52; $i++) {
            $deck->add(new Card());
        }

        $deck->getDeck();
        $card = $deck->getCard(51);

        $this->assertEquals('K', $card->getValueAsString());
        $this->assertEquals(3, $card->getSuitIndex());
    }

    public function testSort()
    {
        $deck = new DeckOfCards();
        for ($i = 0; $i < 52; $i++) {
            $deck->add(new Card());
        }
        $deck->getDeck();
        //$card = $deck->getCard(51);

        $deck1 = $deck;
        $deck1Json = $deck->getJsonStringArray();
        $deck->shuffle();
        $deck->sort();
        $deck2Json = $deck->getJsonStringArray();

        for ($i = 0; $i < 52; $i++) {
            $this->assertEquals($deck1Json[$i], $deck2Json[$i]);
        }

        $this->assertEquals($deck1, $deck);
    }

    public function testRemove()
    {
        $deck = new DeckOfCards();
        for ($i = 0; $i < 52; $i++) {
            $deck->add(new Card());
        }
        $deck->getDeck();
        $num1 = $deck->getNumberCards();
        $deck->remove(new Card(), 52 - $num1);
        $num2 = $deck->getNumberCards();
        $this->assertEquals($num1, $num2 + 1);

    }

    public function testArrays()
    {
        $deck = new DeckOfCards();
        for ($i = 0; $i < 52; $i++) {
            $deck->add(new Card());
        }
        $deck->getDeck();

        $stringArray = $deck->getStringArray();
        $printArray = $deck->getprint();

        $this->assertCount(156, $stringArray);
        $this->assertCount(52, $printArray);
    }

}
