<?php

namespace App\Item;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class BackpackTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateBackpack()
    {
        $item = new Backpack();
        $this->assertInstanceOf("\App\Item\Backpack", $item);
        
    }

    public function testAdd()
    {
        $item = new Item();
        $bp = new Backpack();
        $item->setApple();
        $bp->add($item);
        $this->assertEquals(1,$bp->getNumberItems());
        
    }

    public function testRemove()
    {
        $item = new Item();
        $bp = new Backpack();
        $item->setApple();
        $bp->remove(0);
        $this->assertEquals(0,$bp->getNumberItems());
        
    }
    public function testGetItem()
    {
        $item = new Item();
        $bp = new Backpack();
        $item->setApple();
        $bp->add($item);
        $this->assertInstanceOf("\App\Item\Item", $bp->getItem(0));
    }

}
