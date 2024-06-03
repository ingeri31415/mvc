<?php

namespace App\Item;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class ItemTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateItem()
    {
        $item = new Item();
        $this->assertInstanceOf("\App\Item\Item", $item);
        
    }

    public function testSetName()
    {
        $item = new Item();
        $name = $item->setName("thename");
        $this->assertEquals("thename", $name);
        $this->assertEquals("thename", $item->info());
        
    }

    public function testSetApple()
    {
        $apple = new Item();
        $apple->setApple();

        $this->assertEquals("apple", $apple->info());
        $this->assertEquals("You can't read apples", $apple->read());
        $this->assertEquals("You ate the apple. Inside was a key", $apple->eat());
        $this->assertEquals("there's noone to give the apple to", $apple->give());

    }

    public function testSetBook()
    {
        $apple = new Item();
        $apple->setBook("book","info in book");

        $this->assertEquals("book", $apple->info());
        $this->assertEquals("info in book", $apple->read());
        $this->assertEquals("You can't eat the book", $apple->eat());
        $this->assertEquals("there's noone to give the book to", $apple->give());

    }

    public function testSetkey()
    {
        $apple = new Item();
        $apple->setKey();

        $this->assertEquals("key", $apple->info());
        $this->assertEquals("You can't read keys", $apple->read());
        $this->assertEquals("You can't eat keys", $apple->eat());
        $this->assertEquals("there's noone to give the key to", $apple->give());

    }

}




