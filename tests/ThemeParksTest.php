<?php

use Illuminate\Support\Collection;
use ThemeParks\Disney\WaltDisneyWorld\MagicKingdom;
use ThemeParks\Park;
use ThemeParks\Universal\Orlando\UniversalStudiosFlorida;
use PHPUnit\Framework\TestCase;

class ThemeParkTest extends TestCase
{
    public function testFetchOpeningTimes()
    {
        $park = new UniversalStudiosFlorida();
        $this->assertInstanceOf(Park::class, $park);

        $openingTimes = $park->fetchOpeningTimes();
        
        $this->assertIsArray($openingTimes->toArray());
        $this->assertInstanceOf(DateTime::class, $openingTimes->first()->openingTime);
        $this->assertInstanceOf(Collection::class, $openingTimes->first()->special);
    }

    public function testFetchWaitTimes()
    {
        $park = new MagicKingdom();
        $this->assertInstanceOf(Park::class, $park);
        
        $waitTimes = $park->fetchWaitTimes();

        $this->assertIsArray($waitTimes->toArray());
        $this->assertIsBool($waitTimes->where('active', true)->first()->active);
        $this->assertIsInt($waitTimes->where('waitTime', '>', 0)->first()->waitTime);
    }
}
