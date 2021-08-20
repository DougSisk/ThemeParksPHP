<?php

namespace ThemeParks;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Collection;

class Client
{
    /**
     * HTTP client
     *
     * @var \GuzzleHttp\Client
     */
    private GuzzleClient $http;

    /**
     * Create new client instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->http = new GuzzleClient([
            'base_uri' => 'https://api.themeparks.wiki/v1/',
            'headers' => [
                'Accept' => 'application/json',
                'User-Agent' => 'ThemeParksPHP',
            ],
        ]);
    }

    /**
     * Get list of available destinations
     *
     * @return \Illuminate\Support\Collection
     */
    public function getDestinations(): Collection
    {
        $response = $this->http->get('destinations');
        $destinations = new Collection(json_decode((string) $response->getBody())->destinations);

        return $destinations->map(function ($destination) {
            return new Destination(
                $destination->id,
                $destination->name,
                $destination->slug
            );
        });
    }

    /**
     * Get children of entity
     *
     * @param  string $entityId
     * @return \Illuminate\Support\Collection
     */
    public function getEntityChildren(string $entityId): Collection
    {
        $children = new Collection($this->sendGet('entity/' . $entityId . '/children')->children);

        return $children->map(function ($entity) {
            return $this->initializeEntity($entity);
        })->keyBy('id');
    }

    public function getDestinationLive(string $destinationId): Collection
    {
        $response = $this->sendGet('entity/' . $destinationId . '/live');

        return (new Collection($response->liveData))->map(function ($responseEntity) {
            $entity = $this->initializeEntity($responseEntity);

            if (method_exists($entity, 'populate')) {
                $entity->populate($responseEntity);
            }

            return $entity;
        })->keyBy('id');
    }

    /**
     * Map API response entity to appropriate class
     *
     * @param  object $entity
     * @return \ThemeParks\Entity
     */
    private function initializeEntity(object $entity): Entity
    {
        if ($entity->entityType == Entity::TYPE_ATTRACTION) {
            return new Attraction($entity->id, $entity->name, $entity->parkId ?? null);
        } elseif ($entity->entityType == Entity::TYPE_DESTINATION) {
            return new Destination($entity->id, $entity->name, $entity->slug);
        } elseif ($entity->entityType == Entity::TYPE_PARK) {
            return new Park($entity->id, $entity->name);
        }

        return new Entity($entity->id, $entity->name, $entity->entityType);
    }

    /**
     * Send and receive JSON GET request
     *
     * @param  string $path
     * @return object
     */
    private function sendGet(string $path): object
    {
        return json_decode((string) $this->http->get($path)->getBody());
    }
}
