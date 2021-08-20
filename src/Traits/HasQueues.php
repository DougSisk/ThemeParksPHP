<?php

namespace ThemeParks\Traits;

use Illuminate\Support\Collection;
use ThemeParks\Queue\Queue;

trait HasQueues
{
    /**
     * Available queue options
     *
     * @var \Illuminate\Support\Collection
     */
    public Collection $queue;

    /**
     * Get current wait time, if available
     *
     * @return int
     */
    public function waitTime(): ?int
    {
        if ($standby = $this->queue->where('type', Queue::TYPE_STANDBY)->first()) {
            return $standby->waitTime;
        }

        return null;
    }
}
