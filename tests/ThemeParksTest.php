<?php

use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use ThemeParks\Destinations\Disney\WaltDisneyWorld\MagicKingdom;
use ThemeParks\Entity;
use ThemeParks\Known\KnownPark;
use ThemeParks\Park;

class ThemeParkTest extends TestCase
{
    public function testFetchWaitTimes()
    {
        $park = new MagicKingdom();
        $this->assertInstanceOf(KnownPark::class, $park);
        $this->assertInstanceOf(Park::class, $park->entity);
        $this->assertSame($park->entity->name, 'Magic Kingdom Park');

        $live = $park->getLiveChildren();

        $this->assertInstanceOf(Collection::class, $live);
        $this->assertInstanceOf(Collection::class, $live->where('type', Entity::TYPE_ATTRACTION)->first()->queue);
    }
}
