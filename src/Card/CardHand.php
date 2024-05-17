<?php

namespace App\Card;

class CardHand extends Card
{
    /** @var array<Card> */
    private $hand = [];


    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

    /** @return array<string> */
    public function getStringArray(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            if ($card->getSuit()) {
                $values[] = "[";
                $values[] = $card->getPrint()[0];
                $values[] = "]\t";
            }
        }
        return $values;
    }

    /** @return array<string> */
    public function getPrint(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $card->print;
        }
        return $values;
    }

    /** @return array<string> */
    public function getJsonStringArray(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            if ($card->getSuit()) {
                $values[] = $card->getPrint()[0];

            }
        }
        return $values;
    }




}
