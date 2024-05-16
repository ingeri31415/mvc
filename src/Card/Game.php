<?php

namespace App\Card;

class Game extends Player
{
    /** @var array<Player> */
    private array $players = [];

    // public function __construct()
    // {
    //     $this->players->add( new Player());
    //     $this->players->add( new Player());
    // }

    public function addPlayer(Player $play): void
    {
        $this->players[] = $play;
    }

    /** @return Player */
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
        $bankScore = $this->players[0]->getScore();
        $playerScore = $this->players[1]->getScore();
        $winner = "The bank";
        if ($playerScore > $bankScore) {
            $winner = "You";
        }
        if ($playerScore > 21) {
            $winner = "The bank";
        }

        if ($bankScore > 21) {
            $winner = "You";
        }

        return $winner;

    }
}
