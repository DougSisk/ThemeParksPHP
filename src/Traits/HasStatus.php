<?php

namespace ThemeParks\Traits;

use ThemeParks\Entity;

trait HasStatus
{
    /**
     * Status of entity
     *
     * @var string
     */
    public string $status;

    /**
     * Checks status to see if entity is closed
     *
     * @return bool
     */
    public function closed(): bool
    {
        return $this->status === Entity::STATUS_CLOSED;
    }

    /**
     * Checks status to see if entity is down
     *
     * @return bool
     */
    public function down(): bool
    {
        return $this->status === Entity::STATUS_DOWN;
    }

    /**
     * Checks status to see if entity is operating
     *
     * @return bool
     */
    public function operating(): bool
    {
        return $this->status === Entity::STATUS_OPERATING;
    }
}
