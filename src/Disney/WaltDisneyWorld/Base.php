<?php

namespace ThemeParks\Disney\WaltDisneyWorld;

use DateTimeZone;
use ThemeParks\Park;

abstract class Base extends Park
{
    public function __construct()
    {
        parent::__construct();

        $this->timezone = new DateTimezone('America/New_York');
    }
}
