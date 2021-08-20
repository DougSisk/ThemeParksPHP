<?php

namespace ThemeParks;

class Park extends Entity
{
    use Traits\HasChildren;

    public string $type = parent::TYPE_PARK;

    /**
     * Create new park instance
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
