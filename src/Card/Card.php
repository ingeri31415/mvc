<?php 

namespace App\Card;

class Card
{
    protected $value;
    protected $suit;
    protected $print;

    private $suits = [
         "♠",
         '♥',
         '◆',
         '♣',

    ];

    private $vals = [
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
        $this->value = null;
        $this->suit = null;
    }

    public function setValue(): string
    {
        $this->value = $this->vals[random_int(0, 12)];
        return $this->value;
    }

    public function setSuit(): String
    {
        $this->suit = $this->suits[random_int(1, 4)-1];
        return $this->suit;
    }

    public function setPrint(): String
    {
        $this->print = $this->suit.$this->value;;
        return $this->suit;
    }

    public function getPrint(): array
    {
        $print = $this->print;
        return [$print];
    }

    public function detValue($val): String
    {
        $this->value = $this->vals[$val];
        return $this->value;
    }

    public function detSuit($su): String
    {
        $this->suit = $this->suits[$su];
        return $this->suit;
    }

    public function getValue(): int
    {
        $value = $this->value;
        if ($value == 'A'){
            $value = 1;
        } 
        if ($value == 'J'){
            $value = 11;
        } 
        if ($value == 'Q'){
            $value = 12;
        } 
        if ($value == 'K'){
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
        $suit =$this->suit;
        if ($suit == "♠"){
            $suit = 0;
        }
        else if ($suit == '♥'){
            $suit = 1;
        }
        else if ($suit == '◆'){
            $suit = 2;
        }
        else if ($suit == '♣'){
            $suit = 3;
        }
        else {
            $suit=-1;
        }
        
        return $suit;
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
