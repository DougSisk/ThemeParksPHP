<?php

namespace ThemeParks\Queue;

class WaitTime extends Queue
{
    /**
     * Current posted wait time in minutes
     *
     * @var int
     */
    public ?int $waitTime;

    public function __construct(string $type, ?int $waitTime)
    {
        $this->type = $type;
        $this->waitTime = $waitTime;
    }
}
