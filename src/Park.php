<?php

namespace ThemeParks;

use DateTimeZone;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

abstract class Park
{
    public Collection $attractions;

    private Client $client;

    public string $name;

    public Collection $schedule;

    public ?DateTimeZone $timezone = null;

    public function __construct()
    {
        $this->attractions = new Collection();
        $this->client = new Client([
            'base_uri' => 'https://api.themeparks.wiki/preview/parks/' . $this->parkApiId . '/',
        ]);
        $this->schedule = new Collection();
    }

    public function fetchOpeningTimes(): Collection
    {
        $response = $this->client->get('calendar');
        $data = json_decode((string) $response->getBody());

        foreach ($data as $schedule) {
            if (! $this->schedule->get($schedule->date)) {
                $this->schedule->put($schedule->date, new Schedule($schedule->openingTime, $this->timezone));
            }

            $this->schedule->get($schedule->date)
                ->setClosingTime($schedule->closingTime)
                ->setOpeningTime($schedule->openingTime)
                ->setSpecial($schedule->special ?? [])
                ->setType($schedule->type);
        }

        return $this->schedule;
    }

    public function fetchWaitTimes(bool $includeUuid = false): Collection
    {
        $response = $this->client->get('waittime');
        $data = new Collection(json_decode((string) $response->getBody()));

        if (! $includeUuid) {
            $data->filter(function ($attraction) {
                return preg_match("/{$this->parkApiId}_[0-9]+/", $attraction->id);
            })->transform(function ($attraction) {
                $attraction->id = $this->filterAttractionId($attraction->id);

                return $attraction;
            });
        } else {
            $data->transform(function ($attraction) {
                if (preg_match("/{$this->parkApiId}_[0-9]+/", $attraction->id)) {
                    $attraction->id = $this->filterAttractionId($attraction->id);
                }

                return $attraction;
            });
        }

        foreach ($data as $attraction) {
            if (! $this->attractions->get($attraction->id)) {
                $this->attractions->put($attraction->id, new Attraction($attraction->id, $attraction->name));
            }

            $this->attractions->get($attraction->id)
                ->updateActive($attraction->active)
                ->updateFastPass($attraction->fastPass)
                ->updateLastUpdate($attraction->lastUpdate)
                ->updateMeta($attraction->meta)
                ->updateSingleRider($attraction->meta->singleRider ?? false)
                ->updateStatus($attraction->status)
                ->updateWaitTime($attraction->waitTime);
        }

        return $this->attractions;
    }

    protected function filterAttractionId(string $id)
    {
        return explode('_', $id)[1];
    }
}
