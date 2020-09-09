<?php

namespace GildedRose;

class GildedRose
{
    public static function of($name, $quality, $sell_in)
    {
        switch ($name) {

            case 'normal':
                return new ItemExtended($name, $sell_in, $quality);

            case 'Aged Brie':
                return new AgedBrie($name, $sell_in, $quality);

            case 'Sulfuras, Hand of Ragnaros':
                return new Sulfuras($name, $sell_in, $quality);

            case 'Backstage passes to a TAFKAL80ETC concert':
                return new Backstage($name, $sell_in, $quality);

            case 'Conjured Mana Cake':
                return new Conjured($name, $sell_in, $quality);
        }
    }
}
