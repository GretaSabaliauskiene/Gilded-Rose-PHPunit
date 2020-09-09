<?php

namespace GildedRose;


class ItemExtended
{
    public $item;

    public function __construct($name, $sell_in, $quality)
    {
        $this->item = new Item($name, $sell_in, $quality);
    }
    public function tick()
    {
        $this->item->sell_in -= 1;

        if ($this->item->quality <= 0) {
            return;
        }
        $this->item->quality -= 1;

        if ($this->item->sell_in <= 0 && $this->item->quality > 0) {
            $this->item->quality -= 1;
        }
    }
}
