<?php

namespace ThemeParks\Disney;

use DateTimeZone;
use ThemeParks\Park;

final class ShanghaiDisneyland extends Park
{
    public string $name = 'Shanghai Disneyland';

    protected $parkApiId = 'ShanghaiDisneylandPark';

    public function __construct()
    {
        parent::__construct();

        $this->timezone = new DateTimezone('Asia/Shanghai');
    }

    protected function filterAttractionId(string $id): string
    {
        preg_match("/^({$this->parkApiId}_att)(.*?)$/i", $id, $matches);

        return $matches[2];
    }
}
