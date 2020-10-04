<?php

namespace ThemeParks;

use DateTime;

class Attraction
{
    public bool $active = false;

    public bool $fastPass = false;

    public $id;

    public DateTime $lastUpdate;

    public object $meta;

    public string $name;

    public bool $singleRider = false;

    public string $status = 'Closed';

    public ?int $waitTime = null;

    public function __construct($id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function updateActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function updateFastPass(bool $fastPass): self
    {
        $this->fastPass = $fastPass;

        return $this;
    }

    public function updateLastUpdate($lastUpdate): self
    {
        if (! $lastUpdate instanceof DateTime) {
            $lastUpdate = new DateTime($lastUpdate);
        }

        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function updateMeta(?object $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    public function updateSingleRider(bool $singleRider): self
    {
        $this->singleRider = $singleRider;

        return $this;
    }

    public function updateStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function updateWaitTime(?int $waitTime): self
    {
        $this->waitTime = $waitTime;

        return $this;
    }
}
