<?php

namespace App\Item;

class Item
{
    protected String $name;
    protected String $readText;
    protected String $eatText;
    protected String $giveText;

    public function __construct()
    {
        $this->name = "";
        $this->readText = "";
        $this->eatText = "";
        $this->giveText = "";

    }

    public function setName($name): string
    {
        $this->name = $name;
        return $this->name;
    }

    public function setApple(): void
    {
        $this->name = "apple";
        $this->readText = "You can't read apples";
        $this->eatText = "You ate the apple. Inside was a key";
        $this->giveText = "there's noone to give the apple to";
    }

    public function setBook(string $name, string $mes): void
    {
        $this->name = $name;
        $this->readText = $mes;
        $this->eatText = "You can't eat the " . $name;
        $this->giveText = "there's noone to give the " . $name . " to";
    }

    public function setKey(): void
    {
        $this->name = "key";
        $this->readText = "You can't read keys";
        $this->eatText = "You can't eat keys";
        $this->giveText = "there's noone to give the key to";
    }



    public function info(): string
    {
        return $this->name;
    }

    public function eat(): string
    {
        return $this->eatText;
    }

    public function read(): string
    {
        return $this->readText;
    }

    public function give(): string
    {
        return $this->giveText;
    }
}
