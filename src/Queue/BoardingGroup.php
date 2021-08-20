<?php

namespace ThemeParks\Queue;

use Carbon\Carbon;

class BoardingGroup extends Queue
{
    /**
     * Status of allocation
     *
     * @var string
     */
    public ?string $allocationStatus;

    /**
     * Ending number of group being boarded
     *
     * @var int
     */
    public ?int $currentGroupEnd;

    /**
     * Starting number of group being boarded
     *
     * @var int
     */
    public ?int $currentGroupStart;

    /**
     * Estimated wait time
     *
     * @var int
     */
    public ?int $estimatedWait;

    /**
     * Next allocation timestamp
     *
     * @var \Carbon\Carbon
     */
    public ?Carbon $nextAllocationTime;

    public string $type = parent::TYPE_BOARDING_GROUP;

    public function setAllocationStatus(?string $status): self
    {
        $this->allocationStatus = $status;

        return $this;
    }

    public function setCurrentGroups(?int $start, ?int $end): self
    {
        $this->currentGroupStart = $start;
        $this->currentGroupEnd = $end;

        return $this;
    }

    public function setEstimatedWait(?int $waitTime): self
    {
        $this->estimatedWait = $waitTime;

        return $this;
    }

    public function setNextAllocationTime(?string $timestamp): self
    {
        $this->nextAllocationTime = $timestamp ? Carbon::parse($timestamp) : null;

        return $this;
    }
}
