<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GameService;
use Illuminate\Validation\Rule;

class MatchesTable extends Component
{
    public $matches = [];
    public ?string $dateFilter = null;
    public ?string $textFilter = null;
    public string $sortBy = 'date';
    public string $sortDirection = 'asc';

    protected GameService $gameService;

    public function mount(GameService $gameService)
    {
        $this->gameService = $gameService;
        $this->loadMatches();
    }
    
    public function render()
    {
        // Always emit the current filtered matches when rendering
        $this->dispatch('matchesUpdated', $this->filteredMatches);
        return view('livewire.matches-table');
    }

    public function updatedDateFilter(): void
    {
        $this->loadMatches();
    }

    public function updatedTextFilter(): void
    {
        $this->loadMatches();
    }

    public function sortByDirection(string $field, string $direction): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }

        $this->loadMatches();
    }

    private function loadMatches(): void
    {
        $this->matches = $this->gameService->getMatches(
            $this->dateFilter,
            $this->textFilter,
            $this->sortBy,
            $this->sortDirection
        );
    }
}
