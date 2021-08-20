<?php

namespace ThemeParks;

class Entity
{
    public const STATUS_CLOSED = 'CLOSED';

    public const STATUS_DOWN = 'DOWN';

    public const STATUS_OPERATING = 'OPERATING';

    public const TYPE_ATTRACTION = 'ATTRACTION';

    public const TYPE_DESTINATION = 'DESTINATION';

    public const TYPE_PARK = 'PARK';

    public const TYPE_RESTAURANT = 'RESTAURANT';

    public const TYPE_SHOW = 'SHOW';

     /**
     * UUID of the entity
     *
     * @var string
     */
    public string $id;

    /**
     * Name of the entity
     *
     * @var string
     */
    public string $name;

    /**
     * Type of entity
     *
     * @var string
     */
    public string $type;

    /**
     * Create new entity instance
     *
     * @param  string  $id
     * @param  string  $name
     * @param  string  $type
     * @return void
     */
    public function __construct(string $id, string $name, string $type)
    {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
    }
}
