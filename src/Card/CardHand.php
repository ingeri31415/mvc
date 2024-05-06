<?php

namespace App\Card;

class CardHand extends Card
{
    private $hand = [];
    private $number;


    public function add(Card $card): void
    {
        $this->hand[] = $card;
    }

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

    public function getPrint(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            $values[] = $this->print;
        }
        return $values;
    }

    public function getJsonStringArray(): array
    {
        $values = [];
        foreach ($this->hand as $card) {
            if ($card->getSuit()) {
                $values[] = $card->getPrint();

            }
        }
        return $values;
    }




}
