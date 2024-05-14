<?php

namespace App\Card;

class Game extends Player
{
    private $players = [];

    // public function __construct()
    // {
    //     $this->players->add( new Player());
    //     $this->players->add( new Player());
    // }

    public function addPlayer(Player $play): void
    {
        $this->players[] = $play;
    }

    public function getBank(): Player
    {
        return $this->players[0];
    }

    public function getPlayer(): Player
    {
        return $this->players[1];
    }

    public function winner(): string
    {
        $bank_score = $this->players[0]->getScore();
        $player_score = $this->players[1]->getScore();
        $winner = "The bank";
        if ($player_score > $bank_score) {
            $winner = "You";
        }
        if ($player_score > 21) {
            $winner = "The bank";
        }

        return $winner;

    }
}
