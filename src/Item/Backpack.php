<?php

namespace App\Item;

use App\Item\Item;

class Backpack
{
    /** @var array<Item> */
    private $bp = [];

    public function add(Item $item): void
    {
        $this->bp[] = $item;
    }

    public function remove(int $num): void
    {
        //$length = count($this->bp);
        //for ($i = $num; $i<$length-1; $i++ )
        //{
        //    $this->bp[$i] = $this->bp[$i+1];
        //}
        array_splice($this->bp, $num, $num + 1);

    }

    public function getString(): array
    {
        $items = [];
        foreach ($this->bp as $item) {
            $info = $item->info();
            if ($info) {
                $items[] = $item->info();
            }
        }
        return $items;
    }
    public function getItem($num): Item
    {
        $item = $this->bp[$num];
        return $item;
    }

    public function getNumberItems(): int
    {

        return count($this->getString());
    }

}
