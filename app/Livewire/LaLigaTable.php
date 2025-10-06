<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\LaLigaService;
use Illuminate\Support\Collection;

class LaLigaTable extends Component
{
    public Collection $standings;
    public string $highlightTeam = 'Barcelona';

    private LaLigaService $laLigaService;

    public function boot(LaLigaService $laLigaService): void
    {
        $this->laLigaService = $laLigaService;
    }

    public function mount(): void
    {
        $this->loadStandings();
    }

    public function loadStandings(): void
    {
        $this->standings = $this->laLigaService->getAllTeams();
    }

    public function render()
    {
        return view('livewire.la-liga-table', [
            'standings' => $this->standings,
            'highlightTeam' => $this->highlightTeam,
        ]);
    }
}
