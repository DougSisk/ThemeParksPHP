<?php

namespace ThemeParks\Known;

use ThemeParks\Client;
use ThemeParks\Park;

abstract class KnownPark extends BaseKnown
{
    /**
     * Initialize park instance
     *
     * @param  \ThemeParks\Client $client
     * @return void
     */
    public function __construct(Client $client = null)
    {
        parent::__construct($client);

        $this->entity = new Park($this->id, $this->name);
    }
}
