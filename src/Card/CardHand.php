<?php
namespace App\Card;

class CardHand extends Card {
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
            $values[] = $card->getSuit();
            $values[] = $card->getValueAsString();
            $values[] = "]\t";
            }
        }
        return $values;
    }




}