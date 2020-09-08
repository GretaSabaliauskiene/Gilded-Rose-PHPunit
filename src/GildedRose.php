<?php

namespace App;

class GildedRose
{
    public static function of($name, $quality, $sellIn)
    {
        switch ($name) {

            case 'normal':
                return new Item($quality, $sellIn);

            case 'Aged Brie':
                return new AgedBrie($quality, $sellIn);

            case 'Sulfuras, Hand of Ragnaros':
                return new Sulfuras($quality, $sellIn);

            case 'Backstage passes to a TAFKAL80ETC concert':
                return new Backstage($quality, $sellIn);
        }
    }
}
