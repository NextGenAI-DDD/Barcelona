<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Services\GameService;

class MatchesTable extends Component
{
    public $matches = [];
    public $dateFilter;
    public $sortBy = 'date';
    public $sortDirection = 'asc';

    private GameService $gameService;

    public function boot(GameService $gameService)
    {
        $this->gameService = $gameService;
    }

    public function mount()
    {
        $this->loadMatches();
    }

    public function updatedDateFilter()
    {
        $this->loadMatches();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }

        $this->loadMatches();
    }

    private function loadMatches()
    {
        $query = $this->gameService->getAllGames();

        if ($this->dateFilter) {
            $query = $query->where('date', 'like', $this->dateFilter . '%');
        }

        $this->matches = $query
            ->sortBy([$this->sortBy => $this->sortDirection === 'asc' ? SORT_ASC : SORT_DESC])
            ->values()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.matches-table');
    }
}
