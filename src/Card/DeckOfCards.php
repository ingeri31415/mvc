<?php

namespace App\Card;

class DeckOfCards extends Card
{
    private $deck = [];
    private $length = 0;

    // private $suits = [
    //     '&#9824;',
    //     '&#9829',
    //     '&#9827',
    //     '&#9830',

    // ];

    public function add(Card $card): void
    {
        $this->deck[] = $card;
        $this->length++;
    }

    public function remove(Card $card, $num): void
    {
        //$drawn = $this->deck[$num]->getValueAsString();
        $this->deck[$num] = $card;
        $this->length--;

        //return $drawn;
    }

    public function getCard($num): Card
    {
        //$drawn = $this->deck[$num]->getValueAsString();
        $card = $this->deck[$num] ;
        return $card;
    }

    public function getDeck(): void
    {

        $cardVal = 1;
        $cardSuit = 0;

        foreach ($this->deck as $card) {
            if ($cardVal == 14) {
                $cardVal = 1;
                $cardSuit++;
            }
            $card->detValue($cardVal - 1);
            $card->detSuit($cardSuit);
            $card->setPrint();
            $cardVal++;

            //$this->length++;

        }
    }


    public function shuffleDeck(): array
    {

        $tempDeck = $this->getDeck();
        $newDeck = [];

        for ($i = 0; $i < 52; $i++) {

            $NewDeck->add(new Card());
        }

        $cardsLeft = 52;
        foreach ($newDeck as $card) {

            $num = random_int(0, $cardsLeft);

            $card->detValue();
            $card->detSuit($cardSuit);

            $cardsLeft--;

        }

    }

    public function drawCard(): Card
    {

        $drawnCard = $this->deck[0];
        $this->deck[0] -> NewCard();
        $this->length--;

        return $drawnCard;
    }


    public function getNumberCards(): int
    {
        return $this->length;
    }

    public function getValues(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    public function getString(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $val =  $card->getAsString();
            $su = $card->getSuit();

            $cardstring =  $val + $su;
            $values[] = $cardstring;
        }
        return $values;
    }

    public function getStringArray(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            if ($card->getSuit()) {
                $values[] = "[";
                $values[] = $card->getPrint()[0];

                $values[] = "]\t";
            }
        }
        return $values;
    }

    public function getJsonStringArray(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            if ($card->getSuit()) {
                $values[] = $card->getPrint();

            }
        }
        return $values;
    }


    public function shuffle(): void
    {
        for ($i = 53 - $this->length; $i <= 52; $i++) {
            $last = 52 - $i;
            $index = random_int(0, $last);
            $picked = $this->deck[$index];
            $this->deck[$index] = $this->deck[52 - $i];
            $this->deck[52 - $i] = $picked;
        }
    }

    public function sort_wrong(): void
    {
        $nextSuitIndex = $this->deck[0]->getSuitIndex();
        $old = $this->deck[0];
        for ($i = 0; $i <= 51; $i++) {

            if ($nextSuitIndex == 0) {
                $nextPos = $old->getValue() - 1;
            } elseif ($nextSuitIndex == 1) {
                $nextPos = 13 + $old->getValue() - 1;
            } elseif($nextSuitIndex == 2) {
                $nextPos = 26 + $old->getValue() - 1;
            } else {
                $nextPos = 39 + $old->getValue() - 1;
            }
            $new = $this->deck[$nextPos];
            $this->deck[$nextPos] = $old;
            $nextSuitIndex = $new->getSuitIndex();
            $old = $new;

        }

    }

    public function sort(): void
    {
        for ($i = 50; $i >= 0; $i--) {
            for ($j = 0; $j <= $i; $j++) {

                $cur = $this->deck[$j];
                $next = $this->deck[$j + 1];
                if ($cur->getSuit()) {
                    if ($cur->getSuitIndex() > $next->getSuitIndex()) {
                        $temp = $this->deck[$j];
                        $this->deck[$j] = $this->deck[$j + 1];
                        $this->deck[$j + 1] = $temp;
                    } elseif ($cur->getSuitIndex() == $next->getSuitIndex()) {

                        if ($cur->getValue() > $next->getValue()) {
                            $temp = $this->deck[$j];
                            $this->deck[$j] = $this->deck[$j + 1];
                            $this->deck[$j + 1] = $temp;
                        }
                    }
                }
            }
        }

    }

    public function getPrint(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $this->suit.$this->value;
        }
        return $values;
    }
}
