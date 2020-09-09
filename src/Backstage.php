<?php

namespace GildedRose;


class Backstage extends ItemExtended
{
    public function tick()
    {
        $this->item->quality += 1;

        if ($this->item->sell_in <= 10) {
            $this->item->quality += 1;
        }

        if ($this->item->sell_in <= 5) {
            $this->item->quality += 1;
        }

        if ($this->item->sell_in <= 0) {
            $this->item->quality = 0;
        }

        if ($this->item->quality > 50) {
            $this->item->quality = 50;
        }

        $this->item->sell_in -= 1;
    }
}
