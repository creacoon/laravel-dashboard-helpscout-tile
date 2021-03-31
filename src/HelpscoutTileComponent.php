<?php

namespace Creacoon\HelpscoutTile;

use Livewire\Component;
use Illuminate\Support\Facades\Config;

class HelpscoutTileComponent extends Component
{
    public string $position;
    public int $mailboxId;

    public function mount(string $position, int $mailboxId)
    {
        $this->position = $position;
        $this->mailboxId = $mailboxId;
    }
    
    public function render()
    {
        return view('dashboard-helpscout-tile::tile', [
            'helpscoutData' => HelpscoutTileStore::make()->getData(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.helpscout.refresh_interval_in_seconds') ?? 60,
            'no_active_tickets_text' => config('dashboard.tiles.helpscout.no_active_tickets_text'),
        ]);
    }
}