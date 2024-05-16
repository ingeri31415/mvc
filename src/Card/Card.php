<?php

namespace App\Card;

class Card
{
    protected string $value;
    protected string $suit;
    protected string $print;

    /** @var array<string> */
    private array $suits = [
         "♠",
         '♥',
         '◆',
         '♣',

    ];

    /** @var array<string> */
    private array $vals = [
        'A',
        '2',
        '3',
        '4',
        '5',
        '6',
        '7',
        '8',
        '9',
        '10',
        'J',
        'Q',
        'K',

   ];

    // private $suits = [
    //     '&#x2660',
    //     '&#9829',
    //     '&#9827',
    //     '&#9830',

    // ];

    public function __construct()
    {
        $this->value = "";
        $this->suit = "";
    }

    public function setValue(): string
    {
        $this->value = $this->vals[random_int(0, 12)];
        return $this->value;
    }

    public function setSuit(): String
    {
        $this->suit = $this->suits[random_int(1, 4) - 1];
        return $this->suit;
    }

    public function setPrint(): String
    {
        $this->print = $this->suit.$this->value;

        return $this->suit;
    }
    /** @return array<string> */
    public function getPrint(): array
    {
        $print = $this->print;
        return [$print];
    }

    /**
     * @param int $val
     */
    public function detValue($val): String
    {
        $this->value = $this->vals[$val];
        return $this->value;
    }
    /**
     * @param int $thesuit
     */
    public function detSuit($thesuit): String
    {
        $this->suit = $this->suits[$thesuit];
        return $this->suit;
    }

    public function getValue(): int
    {
        $value = $this->value;
        if ($value == 'A') {
            $value = 1;
        }
        if ($value == 'J') {
            $value = 11;
        }
        if ($value == 'Q') {
            $value = 12;
        }
        if ($value == 'K') {
            $value = 13;
        }
        return $value;
    }
    public function getValueAsString(): string
    {
        return "{$this->value}";
    }

    public function getSuit(): String
    {
        return "{$this->suit}";
    }

    public function getSuitIndex(): int
    {
        $suit = $this->suit;
        if ($suit == "♠") {
            return 0;
        }
        if ($suit == '♥') {
            return 1;
        }
        if ($suit == '◆') {
            return 2;
        }
        if ($suit == '♣') {
            return 3;
        }

        return -1;
    }
    // public function getAsString(): string
    // {
    //     $val = $this->getValueAsString();
    //     $su = $this->getSuit();
    //     //$cardstring = $val.concat($su);
    //     //$cardstring =  $val + $su;
    //     //$stringCard = $this->suit + $this->getValueAsString();
    //     return "$this->$su";
    // }
}
