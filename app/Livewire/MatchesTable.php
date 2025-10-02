<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GameService;
use Illuminate\Validation\Rule;

class MatchesTable extends Component
{
    public $matches = [];
    public ?string $textFilter = null;
    public string $sortBy = 'date';
    public string $sortDirection = 'asc';

    public function mount()
    {
        $this->loadMatches();
    }

    public function updatedTextFilter(): void
    {
        $this->loadMatches();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }

        $this->loadMatches();
    }

    public function sortByDate($direction)
    {
        $this->sortBy = 'date';
        $this->sortDirection = $direction;
        $this->loadMatches();
    }

    public function sortOldest()
    {
        $this->sortBy = 'date';
        $this->sortDirection = 'asc';
        $this->loadMatches();
    }

    public function sortNewest()
    {
        $this->sortBy = 'date';
        $this->sortDirection = 'desc';
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
        $gameService = app(GameService::class);
        $this->matches = $gameService->getMatches(
            null, // brak filtrowania po dacie
            $this->textFilter,
            $this->sortBy,
            $this->sortDirection
        );
    }

    public function render()
    {
        return view('livewire.matches-table');
    }
}