<?php

namespace App\Card;

class Player
{
    protected int $score;

    public function __construct()
    {
        $this->score = 0;
    }

    public function addToScore(int $num): void
    {
        $this->score = $this->score + $num ;
    }

    public function getScore(): String
    {
        return "{$this->score}";
    }
}
