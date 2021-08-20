<?php

namespace ThemeParks;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Restaurant extends Entity
{
    use Traits\BelongsToPark;
    use Traits\HasLastUpdated;
    use Traits\HasQueues;
    use Traits\HasStatus;

    /**
     * Type of entity
     *
     * @var string
     */
    public string $type = parent::TYPE_RESTAURANT;

    /**
     * Create new destination instance
     *
     * @param  string  $id
     * @param  string  $name
     * @param  string  $parkId
     * @return void
     */
    public function __construct(string $id, string $name, ?string $parkId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parkId = $parkId;
    }

    public function populate(object $data): self
    {
        $this->lastUpdated = Carbon::parse($data->lastUpdated);
        $this->status = $data->status;

        $this->queue = new Collection();

        if (isset($data->queue->STANDBY)) {
            $this->queue->put('STANDBY', new Queue\WaitTime('STANDBY', $data->queue->STANDBY->waitTime));
        }

        return $this;
    }
}
