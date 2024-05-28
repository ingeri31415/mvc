<?php

/**
 * A class for playing cards. Each card has a value and a suit. In addtion they have a value as an int
 * which is diffrent since the string value for an Ace is A and the int value is 1. Then they also
 * have a print which is the string values of vaule and suit as a joint string for easy printing.
 *
 * */

namespace App\Card;

class Card
{
    protected string $value;
    protected int $valueInt;
    protected string $suit;
    protected string $print;

    /**
     * @var array<string>
     */
    private array $suits = [
         "♠",
         '♥',
         '◆',
         '♣',

    ];

    /**
     *  @var array<string>
     */
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

    /**
     * Contructor of the class setting the value and the suit to empty strings
     */

    public function __construct()
    {
        $this->value = "";
        $this->suit = "";
    }

    /**
     * Sets the value to a random string from the vals[] array.
     * The values in the array are A, 2-10, J, Q, K.
     * Returns the value
     */
    public function setValue(): string
    {
        $this->value = $this->vals[random_int(0, 12)];
        return $this->value;
    }

    /**
     * Sets the value of suit to a random string in the suits[] Array
     * Possible values are "♠",'♥','◆' and '♣'
     * Returns the suit
     */
    public function setSuit(): String
    {
        $this->suit = $this->suits[random_int(1, 4) - 1];
        return $this->suit;
    }

    /**
     * Sets the value of print to a concatination of suit and value.
     * Returns the suit
     */
    public function setPrint(): String
    {
        $this->print = $this->suit.$this->value;

        return $this->suit;
    }


    /**
     * A getter for the print which returns the value in an array
     *
     *
     * @return array<string>
     * */
    public function getPrint(): array
    {
        $print = $this->print;
        return [$print];
    }

    /**
     * Sets the value to the input parameter
     *
     * @param int $val
     */
    public function detValue($val): String
    {
        $this->value = $this->vals[$val];
        $this->valueInt = $val + 1;
        return $this->value;
    }
    /**
     * Sets the suit to the input parameter
     *
     *
     * @param int $thesuit
     */
    public function detSuit($thesuit): String
    {
        $this->suit = $this->suits[$thesuit];
        return $this->suit;
    }

    /**
     * A getter for Value which returns the value as an Int
     * */

    public function getValue(): int
    {   
        //$value = $this->valueInt;
        $value = $this->valueInt;
        // if ($value == 'A') {
        //     $value = 1;
        // }
        // if ($value == 'J') {
        //     $value = 11;
        // }
        // if ($value == 'Q') {
        //     $value = 12;
        // }
        // if ($value == 'K') {
        //     $value = 13;
        // }
        if ($value){
            return $value;
        }
        return -1;
    }

    /**
     * A getter for the Value which returns the value as a string
     * */

    public function getValueAsString(): string
    {
        return "{$this->value}";
    }

    /**
     * A getter for the suit which returns the suit as a string
     * */

    public function getSuit(): String
    {
        return "{$this->suit}";
    }


    /**
     * A getter for the Index the suit has in the suits[] array
     *
     * */
    public function getSuitIndex(): int
    {
        //$suit = $this->suit ? $this->suit : -1;
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
