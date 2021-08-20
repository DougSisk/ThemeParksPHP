<?php

namespace ThemeParks;

use JsonSerializable;

class Destination extends Entity implements JsonSerializable
{
    /**
     * Slug of the destination
     *
     * @var string
     */
    public ?string $slug;

    /**
     * Type of entity
     *
     * @var string
     */
    public string $type = parent::TYPE_DESTINATION;

    /**
     * Create new destination instance
     *
     * @param  string  $id
     * @param  string  $name
     * @param  string  $slug
     * @return void
     */
    public function __construct(string $id, string $name, string $slug = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
        ];
    }
}
