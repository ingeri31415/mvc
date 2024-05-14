<?php

namespace App\Card;

class Player
{
    protected $score;

    public function __construct()
    {
        $this->score = 0;
    }

    public function add_to_score($num): void
    {
        $this->score = $this->score + $num ;
    }

    public function getScore(): int
    {
        return "{$this->score}";
    }
}
