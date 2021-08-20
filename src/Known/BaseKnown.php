<?php

namespace ThemeParks\Known;

use Illuminate\Support\Collection;
use ThemeParks\Client;
use ThemeParks\Entity;

abstract class BaseKnown
{
    /**
     * API Client
     *
     * @var \ThemeParks\Client
     */
    private Client $client;

    /**
     * Entity instance
     *
     * @var \ThemeParks\Entity
     */
    public Entity $entity;

    /**
     * Destination UUID
     *
     * @var string
     */
    public string $id;

    /**
     * Destination name
     *
     * @var string
     */
    public string $name;

    /**
     * Initialize instance
     *
     * @param  \ThemeParks\Client $client
     * @return void
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function getChildren(): Collection
    {
        if (! $this->entity->getChildren()) {
            $this->entity->setChildren(
                $this->client->getEntityChildren($this->entity->id)
            );
        }

        return $this->entity->getChildren();
    }

    public function getLiveChildren(): Collection
    {
        $live = $this->client->getDestinationLive($this->entity->id);

        if ($this->entity->getChildren()) {
            $live->each(function ($liveEntity) {
                $this->entity->getChildren()->put($liveEntity->id, $liveEntity);
            });
        } else {
            $this->entity->setChildren($live);
        }

        return $this->entity->getChildren();
    }
}
