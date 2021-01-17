<?php

namespace ThemeParks;

use DateTimeZone;

final class EuropaPark extends Park
{
    public string $name = 'Europa Park';

    protected $parkApiId = 'EuropaPark';

    public function __construct()
    {
        parent::__construct();

        $this->timezone = new DateTimeZone('Europe/Berlin');
    }
}
