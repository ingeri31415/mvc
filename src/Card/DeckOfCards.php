<?php

namespace App\Card;

class DeckOfCards extends Card
{
    /** @var array<Card> */
    private $deck = [];

    /** @var int */
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

    public function remove(Card $card, int $num): void
    {
        //$drawn = $this->deck[$num]->getValueAsString();
        $this->deck[$num] = $card;
        $this->length--;

        //return $drawn;
    }

    public function getCard(int $num): Card
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


    // public function shuffleDeck(): array
    // {


    //     $newDeck = [];

    //     for ($i = 0; $i < 52; $i++) {

    //         $newDeck->add(new Card());
    //     }

    //     $cardsLeft = 52;
    //     foreach ($newDeck as $card) {


    //         $card->detValue();
    //         $card->detSuit($cardSuit);

    //         $cardsLeft--;

    //     }

    // }

    // public function drawCard(): Card
    // {

    //     $drawnCard = $this->deck[0];
    //     //$this->deck[0] -> NewCard();
    //     $this->length--;

    //     return $drawnCard;
    // }


    public function getNumberCards(): int
    {
        return $this->length;
    }

    // /** @return array<string> */
    // public function getValues(): array
    // {
    //     $values = [];
    //     foreach ($this->deck as $card) {
    //         $values[] = $card->getValue();
    //     }
    //     return $values;
    // }

    /** @return array<string> */
    // public function getString(): array
    // {
    //     $values = [];
    //     foreach ($this->deck as $card) {
    //         $val =  $card->getAsString();
    //         $sui = $card->getSuit();

    //         $cardstring =  $val + $sui;
    //         $values[] = $cardstring;
    //     }
    //     return $values;
    // }
    /** @return array<string> */
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

    /** @return array<string> */
    public function getJsonStringArray(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            if ($card->getSuit()) {
                $values[] = $card->getPrint()[0];


            }
        }
        return $values;
    }

    /** @return array<string> */
    public function getJsonString(): string
    {
        $values = "Deck of cards: ";
        foreach ($this->deck as $card) {
            if ($card->getSuit()) {
                $values = $values . $card->getPrint()[0] . " ";
            }
        }
        return $values;
    }


    public function shuffle(): void
    {
        for ($i = 53 - $this->length; $i <= 52; $i++) {
            $last = 52 - $i;
            $last == 0 ? $index = 0 : $index = random_int(0, $last);
            //$index = random_int(0, $last);
            $picked = $this->deck[$index];
            $this->deck[$index] = $this->deck[52 - $i];
            $this->deck[52 - $i] = $picked;
        }
    }

    // public function sort_wrong(): void
    // {
    //     $nextSuitIndex = $this->deck[0]->getSuitIndex();
    //     $old = $this->deck[0];
    //     for ($i = 0; $i <= 51; $i++) {

    //         if ($nextSuitIndex == 0) {
    //             $nextPos = $old->getValue() - 1;
    //         } elseif ($nextSuitIndex == 1) {
    //             $nextPos = 13 + $old->getValue() - 1;
    //         } elseif($nextSuitIndex == 2) {
    //             $nextPos = 26 + $old->getValue() - 1;
    //         } else {
    //             $nextPos = 39 + $old->getValue() - 1;
    //         }
    //         $new = $this->deck[$nextPos];
    //         $this->deck[$nextPos] = $old;
    //         $nextSuitIndex = $new->getSuitIndex();
    //         $old = $new;

    //     }

    // }

    public function sort(): void
    {
        for ($i = 50; $i >= 0; $i--) {
            for ($j = 0; $j <= $i; $j++) {

                $cur = $this->deck[$j];
                $next = $this->deck[$j + 1];
                //if ($cur->getSuit()) {
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
                //}
            }
        }

    }

    /** @return array<string> */
    public function getPrint(): array
    {
        $values = [];
        foreach ($this->deck as $card) {
            $values[] = $card->suit.$card->value;
        }
        return $values;
    }
}
