<?php

namespace App;


class Item
{

    public $sellIn;

    public $quality;


    public function __construct($quality, $sell_in)
    {
        $this->quality = $quality;
        $this->sellIn = $sell_in;
    }

    public function tick()
    {
        $this->sellIn -= 1;

        if ($this->quality <= 0) {
            return;
        }
        $this->quality -= 1;

        if ($this->sellIn <= 0 && $this->quality > 0) {
            $this->quality -= 1;
        }
    }
}
