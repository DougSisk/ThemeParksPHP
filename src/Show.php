<?php

namespace ThemeParks;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use ThemeParks\Show\ShowTime;

class Show extends Entity
{
    use Traits\BelongsToPark;
    use Traits\HasLastUpdated;
    use Traits\HasStatus;

    /**
     * Scheduled show times
     *
     * @var \Illuminate\Support\Collection
     */
    public Collection $showTimes;

    /**
     * Type of entity
     *
     * @var string
     */
    public string $type = parent::TYPE_SHOW;

    /**
     * Create new show instance
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

        $this->showTimes = (new Collection($data->showtimes))->map(function ($showTime) {
            return new ShowTime(
                $showTime->startTime,
                $showTime->endTime,
                $showTime->type
            );
        });

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            'closed' => $this->closed(),
            'down' => $this->down(),
            'id' => $this->id,
            'name' => $this->name,
            'operating' => $this->operating(),
            'showTimes' => $this->showTimes,
            'status' => $this->status,
            'type' => $this->type,
        ];
    }
}
