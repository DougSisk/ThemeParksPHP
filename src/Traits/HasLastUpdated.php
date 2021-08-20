<?php

namespace ThemeParks\Traits;

use Carbon\Carbon;

trait HasLastUpdated
{
    /**
     * When entity was last updated
     *
     * @var \Carbon\Carbon
     */
    public Carbon $lastUpdated;
}
