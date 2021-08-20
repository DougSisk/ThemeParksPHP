<?php

namespace ThemeParks\Traits;

use Illuminate\Support\Collection;

trait HasQueues
{
    /**
     * Available queue options
     *
     * @var \Illuminate\Support\Collection
     */
    public Collection $queue;
}
