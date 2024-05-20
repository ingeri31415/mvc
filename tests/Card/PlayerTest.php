<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */




class PlayerTest extends TestCase
{
    /**
     * Test for initiation of the class.
     */
    public function testCreatePlayer()
    {
        $player = new Player();

        $this->assertInstanceOf("\App\Card\Player", $player);

    }

    /**
     * Test for the addToScore method of player.
     */

    public function testSorePlayer()
    {
        $player = new Player();

        $player->addToScore(10);

        $score = $player->getScore();

        $this->assertEquals(10, $score);

    }

}
