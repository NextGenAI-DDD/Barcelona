<div class="container">
    <!-- Filtry -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" class="form-control"
                   placeholder="Szukaj gracza..."
                   wire:model.debounce.500ms="searchTerm">
        </div>
        <div class="col-md-3">
            <select class="form-select" wire:model="positionFilter">
                <option value="">Wszystkie pozycje</option>
                <option value="GK">Bramkarz</option>
                <option value="DEF">Obrońca</option>
                <option value="MID">Pomocnik</option>
                <option value="FW">Napastnik</option>
            </select>
        </div>
    </div>

    <!-- Tabela -->
    <div wire:loading.class="opacity-50">
        <table class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th wire:click="sortBy('name')" style="cursor:pointer;">Imię</th>
                    <th>Pozycja</th>
                    <th wire:click="sortBy('games_appearances')" style="cursor:pointer;">Mecze</th>
                    <th wire:click="sortBy('goals_total')" style="cursor:pointer;">Gole</th>
                    <th wire:click="sortBy('goals_assists')" style="cursor:pointer;">Asysty</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->position }}</td>
                        <td>{{ $player->playerStats->games_appearances ?? 0 }}</td>
                        <td>{{ $player->playerStats->goals_total ?? 0 }}</td>
                        <td>{{ $player->playerStats->goals_assists ?? 0 }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Brak graczy</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginacja -->
    <div class="d-flex justify-content-center">
        {{ $players->links() }}
    </div>

    <!-- Loading -->
    <div wire:loading>
        <div class="alert alert-info">Ładowanie danych...</div>
    </div>
</div>