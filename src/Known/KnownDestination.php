<?php

namespace ThemeParks\Known;

use Illuminate\Support\Collection;
use ThemeParks\Client;
use ThemeParks\Destination;
use ThemeParks\Entity;

abstract class KnownDestination extends BaseKnown
{
    /**
     * Destination slug
     *
     * @var string
     */
    public string $slug;

    /**
     * Initialize destination instance
     *
     * @param  \ThemeParks\Client $client
     * @return void
     */
    public function __construct(Client $client = null)
    {
        parent::__construct($client);

        $this->entity = new Destination($this->id, $this->name, $this->slug);
    }

    public function getParks(bool $live = false): Collection
    {
        return $this->getChildren()->where('type', Entity::TYPE_PARK)->map(function ($park) use ($live) {
            $park->setChildren(
                ($live ? $this->getLiveChildren() : $this->getChildren())->where('parkId', $park->id)
            );

            return $park;
        });
    }

    public function getLiveParks(): Collection
    {
        return $this->getParks(true);
    }
}
