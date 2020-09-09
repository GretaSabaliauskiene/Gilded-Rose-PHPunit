<?php

namespace GildedRose;


require __DIR__ . "/../src/GildedRose.php";
require __DIR__ . "/../src/Item.php";
require __DIR__ . "/../src/ItemExtended.php";
require __DIR__ . "/../src/Sulfuras.php";
require __DIR__ . "/../src/AgedBrie.php";
require __DIR__ . "/../src/Backstage.php";
require __DIR__ . "/../src/Conjured.php";







use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    /** @test */
    function updates_normal_items_before_sell_date()
    {
        $item = GildedRose::of('normal', 10, 5); // quality, sell in X days

        $item->tick();

        $this->assertEquals(9, $item->item->quality);
        $this->assertEquals(4, $item->item->sell_in);
    }

    /** @test */
    function updates_normal_items_on_the_sell_date()
    {
        $item = GildedRose::of('normal', 10, 0);

        $item->tick();

        $this->assertEquals(8, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_normal_items_after_the_sell_date()
    {
        $item = GildedRose::of('normal', 10, -5);

        $item->tick();

        $this->assertEquals(8, $item->item->quality);
        $this->assertEquals(-6, $item->item->sell_in);
    }

    /** @test */
    function updates_normal_items_with_a_quality_of_0()
    {
        $item = GildedRose::of('normal', 0, 5);

        $item->tick();

        $this->assertEquals(0, $item->item->quality);
        $this->assertEquals(4, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_before_the_sell_date()
    {
        $item = GildedRose::of('Aged Brie', 10, 5);

        $item->tick();

        $this->assertEquals(11, $item->item->quality);
        $this->assertEquals(4, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_before_the_sell_date_with_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 50, 5);

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(4, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_on_the_sell_date()
    {
        $item = GildedRose::of('Aged Brie', 10, 0);

        $item->tick();

        $this->assertEquals(12, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_on_the_sell_date_near_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 49, 0);

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_on_the_sell_date_with_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 50, 0);

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_after_the_sell_date()
    {
        $item = GildedRose::of('Aged Brie', 10, -10);

        $item->tick();

        $this->assertEquals(12, $item->item->quality);
        $this->assertEquals(-11, $item->item->sell_in);
    }

    /** @test */
    function updates_brie_items_after_the_sell_date_with_maximum_quality()
    {
        $item = GildedRose::of('Aged Brie', 50, -10);

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(-11, $item->item->sell_in);
    }

    /** @test */
    function updates_sulfuras_items_before_the_sell_date()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 5);

        $item->tick();

        $this->assertEquals(10, $item->item->quality);
        $this->assertEquals(5, $item->item->sell_in);
    }

    /** @test */
    function updates_sulfuras_items_on_the_sell_date()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 5);

        $item->tick();

        $this->assertEquals(10, $item->item->quality);
        $this->assertEquals(5, $item->item->sell_in);
    }

    /** @test */
    function updates_sulfuras_items_after_the_sell_date()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, -1);

        $item->tick();

        $this->assertEquals(10, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /*
        "Backstage passes", like aged brie, increases in Quality as it's sell_in
        value approaches; Quality increases by 2 when there are 10 days or
        less and by 3 when there are 5 days or less but Quality drops to
        0 after the concert
     */

    /** @test */
    function updates_backstage_pass_items_long_before_the_sell_date()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            10,
            11
        );

        $item->tick();

        $this->assertEquals(11, $item->item->quality);
        $this->assertEquals(10, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_close_to_the_sell_date()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            10,
            10
        );

        $item->tick();

        $this->assertEquals(12, $item->item->quality);
        $this->assertEquals(9, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_close_to_the_sell_data_at_max_quality()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            50,
            10
        );

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(9, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_very_close_to_the_sell_date()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            10,
            5
        );

        $item->tick();

        $this->assertEquals(13, $item->item->quality);
        $this->assertEquals(4, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_very_close_to_the_sell_date_at_max_quality()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            50,
            5
        );

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(4, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_with_one_day_left_to_sell()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            10,
            1
        );

        $item->tick();

        $this->assertEquals(13, $item->item->quality);
        $this->assertEquals(0, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_with_one_day_left_to_sell_at_max_quality()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            50,
            1
        );

        $item->tick();

        $this->assertEquals(50, $item->item->quality);
        $this->assertEquals(0, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_on_the_sell_date()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            10,
            0
        );

        $item->tick();

        $this->assertEquals(0, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_backstage_pass_items_after_the_sell_date()
    {
        $item = GildedRose::of(
            'Backstage passes to a TAFKAL80ETC concert',
            10,
            -1
        );

        $item->tick();

        $this->assertEquals(0, $item->item->quality);
        $this->assertEquals(-2, $item->item->sell_in);
    }

    /** @test */
    function _updates_conjured_items_before_the_sell_date()
    {
        $item = GildedRose::of('Conjured Mana Cake', 10, 10);

        $item->tick();

        $this->assertEquals(8, $item->item->quality);
        $this->assertEquals(9, $item->item->sell_in);
    }

    /** @test */
    function updates_conjured_items_at_zero_quality()
    {
        $item = GildedRose::of('Conjured Mana Cake', 0, 10);

        $item->tick();

        $this->assertEquals(0, $item->item->quality);
        $this->assertEquals(9, $item->item->sell_in);
    }

    /** @test */
    function updates_conjured_items_on_the_sell_date()
    {
        $item = GildedRose::of('Conjured Mana Cake', 10, 0);

        $item->tick();

        $this->assertEquals(6, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_conjured_items_on_the_sell_date_at_0_quality()
    {
        $item = GildedRose::of('Conjured Mana Cake', 0, 0);

        $item->tick();

        $this->assertEquals(0, $item->item->quality);
        $this->assertEquals(-1, $item->item->sell_in);
    }

    /** @test */
    function updates_conjured_items_after_the_sell_date()
    {
        $item = GildedRose::of('Conjured Mana Cake', 10, -10);

        $item->tick();

        $this->assertEquals(6, $item->item->quality);
        $this->assertEquals(-11, $item->item->sell_in);
    }

    /** @test */
    function updates_conjured_items_after_the_sell_date_at_zero_quality()
    {
        $item = GildedRose::of('Conjured Mana Cake', 0, -10);

        $item->tick();

        $this->assertEquals(0, $item->item->quality);
        $this->assertEquals(-11, $item->item->sell_in);
    }
}
