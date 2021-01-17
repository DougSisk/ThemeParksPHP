<?php

namespace ThemeParks;

use DateTimeZone;

final class Efteling extends Park
{
    public string $name = 'Efteling';

    protected $parkApiId = 'Efteling';

    public function __construct()
    {
        parent::__construct();

        $this->timezone = new DateTimeZone('Europe/Amsterdam');
    }
}
