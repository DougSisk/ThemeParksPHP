<?php

namespace ThemeParks;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class Hotel extends Entity
{
    /**
     * Type of entity
     *
     * @var string
     */
    public string $type = parent::TYPE_HOTEL;

    /**
     * Create new hotel instance
     *
     * @param  string  $id
     * @param  string  $name
     * @return void
     */
    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
