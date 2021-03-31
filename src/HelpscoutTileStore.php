<?php

namespace Creacoon\HelpscoutTile;

use Spatie\Dashboard\Models\Tile;

class HelpscoutTileStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName("helpscoutTile");
    }

    public function setData(array $data): self
    {
        $this->tile->putData('helpscoutData', $data);

        return $this;
    }

    public function getData(): array
    {
        return $this->tile->getData('helpscoutData') ?? [];
    }

}
