<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\PlayerService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PlayersStats extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $positionFilter = '';
    public $sortBy = 'goals_total'; 
    public $sortDirection = 'desc';

    private PlayerService $playerService;

    public function boot(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatedPositionFilter()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    private function getFilteredPlayers(): Collection
    {
        $players = $this->playerService->getAllPlayersWithStats();

        if ($this->searchTerm) {
            $players = $players->filter(fn($player) =>
                str_contains(strtolower($player->name), strtolower($this->searchTerm))
            );
        }

        if ($this->positionFilter) {
            $players = $players->where('position', $this->positionFilter);
        }

        $players = $players->sortBy(
            fn($player) => $player->playerStats->{$this->sortBy} ?? 0,
            SORT_REGULAR,
            $this->sortDirection === 'desc'
        );

        return $players->values();
    }

    private function paginate(Collection $items, $perPage = 10): LengthAwarePaginator
    {
        $page = $this->page;
        $offset = ($page - 1) * $perPage;

        return new LengthAwarePaginator(
            $items->slice($offset, $perPage)->values(),
            $items->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
    }

    public function render()
    {
        $players = $this->paginate($this->getFilteredPlayers());

        return view('livewire.players-stats', [
            'players' => $players,
        ]);
    }
}
