<?php

namespace ThemeParks\Disney\Disneyland;

use DateTimeZone;
use ThemeParks\Park;

abstract class Base extends Park
{
    public function __construct()
    {
        parent::__construct();

        $this->timezone = new DateTimezone('America/Los_Angeles');
    }
}
