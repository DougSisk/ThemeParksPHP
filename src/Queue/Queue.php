<?php

namespace ThemeParks\Queue;

abstract class Queue
{
    public const TYPE_BOARDING_GROUP = 'BOARDING_GROUP';

    public const TYPE_RETURN_TIME = 'RETURN_TIME';

    public const TYPE_SINGLE_RIDER = 'SINGLE_RIDER';

    public const TYPE_STANDBY = 'STANDBY';

    /**
     * Type of queue
     *
     * @var string
     */
    public string $type;
}
