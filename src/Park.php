<?php

namespace ThemeParks;

class Park extends Entity
{
    use Traits\HasChildren;

    public string $type = parent::TYPE_PARK;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
