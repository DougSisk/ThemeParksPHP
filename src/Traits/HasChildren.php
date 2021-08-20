<?php

namespace ThemeParks\Traits;

use Illuminate\Support\Collection;

trait HasChildren
{
    /**
     * Children of entity
     *
     * @var \Illuminate\Support\Collection;
     */
    private Collection $children;

    public function getChildren(): ?Collection
    {
        return $this->children ?? null;
    }

    public function setChildren(Collection $children): self
    {
        $this->children = $children;

        return $this;
    }
}
