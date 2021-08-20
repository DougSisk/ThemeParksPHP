<?php

namespace ThemeParks\Show;

use Carbon\Carbon;

class ShowTime
{
    /**
     * Performance end
     *
     * @var \Carbon\Carbon
     */
    public ?Carbon $endTime;

    /**
     * Performance start
     *
     * @var \Carbon\Carbon
     */
    public Carbon $startTime;

    /**
     * Performance type
     *
     * @var string
     */
    public ?string $type;

    public function __construct(string $startTime, ?string $endTime, ?string $type)
    {
        $this->startTime = Carbon::parse($startTime);
        $this->endTime = Carbon::parse($endTime);
        $this->type = $type;
    }
}
