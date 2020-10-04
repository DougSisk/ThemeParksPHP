<?php

namespace ThemeParks;

use DateTime;
use DateTimeZone;
use Illuminate\Support\Collection;

class Schedule
{
    public DateTime $closingTime;

    public string $date;

    public DateTime $openingTime;

    public Collection $special;

    public string $type;

    public ?DateTimeZone $timezone;

    public function __construct($openingTime, ?DateTimeZone $timezone)
    {
        if ($timezone) {
            $this->timezone = $timezone;
        }

        $this->setOpeningTime($openingTime);

        $this->date = $this->openingTime->format('Y-m-d');
    }

    public function setClosingTime($closingTime): self
    {
        if (! $closingTime instanceof DateTime) {
            $closingTime = new DateTime($closingTime);
        }
        $this->closingTime = $closingTime;

        if ($this->timezone) {
            $this->closingTime->setTimezone($this->timezone);
        }

        return $this;
    }

    public function setOpeningTime($openingTime): self
    {
        if (! $openingTime instanceof DateTime) {
            $openingTime = new DateTime($openingTime);
        }
        $this->openingTime = $openingTime;

        if ($this->timezone) {
            $this->openingTime->setTimezone($this->timezone);
        }

        return $this;
    }

    public function setSpecial(array $special): self
    {
        $this->special = (new Collection($special))->map(function ($schedule) {
            $specialSchedule = new self($schedule->openingTime, $this->timezone);
            $specialSchedule->setClosingTime($schedule->closingTime)
                ->setType($schedule->type);

            return $specialSchedule;
        });

        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
