<?php

declare(strict_types = 1);

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;

final class MatchesTable extends Component
{
    public $matches = [];

    public function mount()
    {
        // Pobieramy wszystkie mecze tylko raz przy ładowaniu strony
        $this->matches = Game::all()->toArray();
    }

    public function render()
    {
        return view('livewire.matches-table');
    }
}