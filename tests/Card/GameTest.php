<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    public function testCreateGame()
    {
        $game = new Game();

        $this->assertInstanceOf("\App\Card\Game", $game);

    }

    public function testAddGet()
    {
        $game = new Game();

        $game->addPlayer(new Player());
        $game->addPlayer(new Player());

        $player = $game->getPlayer();
        $bank = $game->getBank();

        $this->assertInstanceOf("\App\Card\Player", $player);
        $this->assertInstanceOf("\App\Card\Player", $bank);
    }

    public function testWinner()
    {
        $game = new Game();

        $game->addPlayer(new Player());
        $game->addPlayer(new Player());

        $game->getPlayer()->addToScore(24);

        $this->assertEquals('The bank', $game->winner());

        $game->getPlayer()->addToScore(-10);
        $game->getBank()->addToScore(24);

        $this->assertEquals('You', $game->winner());

        $game->getBank()->addToScore(-20);

        $this->assertEquals('You', $game->winner());

        $game->getBank()->addToScore(12);

        $this->assertEquals('The bank', $game->winner());
    }

}
