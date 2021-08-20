<?php

namespace ThemeParks;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use JsonSerializable;

class Attraction extends Entity implements JsonSerializable
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
    public string $type = parent::TYPE_ATTRACTION;

    /**
     * Create new attraction instance
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

        if (isset($data->queue->BOARDING_GROUP)) {
            $boardingGroup = new Queue\BoardingGroup();
            $boardingGroup->setAllocationStatus($data->queue->BOARDING_GROUP->allocationStatus);
            $boardingGroup->setEstimatedWait($data->queue->BOARDING_GROUP->estimatedWait);
            $boardingGroup->setNextAllocationTime($data->queue->BOARDING_GROUP->nextAllocationTime);
            $boardingGroup->setCurrentGroups($data->queue->BOARDING_GROUP->currentGroupStart, $data->queue->BOARDING_GROUP->currentGroupEnd);

            $this->queue->put('BOARDING_GROUP', $boardingGroup);
        }

        if (isset($data->queue->PAID_RETURN_TIME)) {
            $paidReturnTime = new Queue\ReturnTime();
            $paidReturnTime->setPrice($data->queue->PAID_RETURN_TIME->price->amount, $data->queue->PAID_RETURN_TIME->price->currency);
            $paidReturnTime->setReturn($data->queue->PAID_RETURN_TIME->returnStart, $data->queue->PAID_RETURN_TIME->returnEnd);
            $paidReturnTime->setState($data->queue->PAID_RETURN_TIME->state);

            $this->queue->put('PAID_RETURN_TIME', $paidReturnTime);
        }

        if (isset($data->queue->RETURN_TIME)) {
            $returnTime = new Queue\ReturnTime();
            $returnTime->setReturn($data->queue->RETURN_TIME->returnStart, $data->queue->RETURN_TIME->returnEnd);
            $returnTime->setState($data->queue->RETURN_TIME->state);

            $this->queue->put('RETURN_TIME', $returnTime);
        }

        if (isset($data->queue->STANDBY)) {
            $this->queue->put('STANDBY', new Queue\WaitTime('STANDBY', $data->queue->STANDBY->waitTime));
        }

        if (isset($data->queue->SINGLE_RIDER)) {
            $this->queue->put('SINGLE_RIDER', new Queue\WaitTime('SINGLE_RIDER', $data->queue->SINGLE_RIDER->waitTime));
        }

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
            'queue' => $this->queue,
            'status' => $this->status,
            'type' => $this->type,
            'waitTime' => $this->waitTime(),
        ];
    }
}
