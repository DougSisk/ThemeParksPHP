<?php

namespace ThemeParks\Queue;

use Carbon\Carbon;

class ReturnTime extends Queue
{
    public const STATE_AVAILABLE = 'AVAILABLE';

    public const STATE_FINISHED = 'FINISHED';

    /**
     * Availability
     *
     * @var bool
     */
    public bool $available;

    /**
     * Wether or not this is a paid return time
     *
     * @var bool
     */
    public bool $paid = false;

    /**
     * Price in cents for paid return time
     *
     * @var int
     */
    public ?int $price = null;

    /**
     * Price currency
     *
     * @var string
     */
    public ?string $priceCurrency = null;

    /**
     * Available end timestamp
     *
     * @var \Carbon\Carbon
     */
    public ?Carbon $returnEnd = null;

    /**
     * Available start timestamp
     *
     * @var \Carbon\Carbon
     */
    public ?Carbon $returnStart = null;

    public $type = parent::TYPE_RETURN_TIME;

    public function setPrice(int $price, string $currency): self
    {
        $this->paid = true;
        $this->price = $price;
        $this->priceCurrency = $currency;

        return $this;
    }

    public function setReturn(?string $start, ?string $end): self
    {
        $this->returnStart = $start ? Carbon::parse($start) : null;
        $this->returnEnd = $end ? Carbon::parse($end) : null;

        return $this;
    }

    public function setState(string $state): self
    {
        $this->available = $state == self::STATE_AVAILABLE;

        return $this;
    }
}
