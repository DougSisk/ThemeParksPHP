<?php

namespace ThemeParks\Universal;

use DateTimezone;
use ThemeParks\Park;

final class UniversalStudios extends Park
{
    public string $name = "Universal Studios Hollywood";

    protected $parkApiId = 'UniversalStudios';

    public function __construct()
    {
        parent::__construct();

        $this->timezone = new DateTimezone('America/Los_Angeles');
    }
}
