<div>
    <!-- Filtrowanie -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="dateFilter" class="form-label">Filtruj po dacie:</label>
            <input type="date"
                   id="dateFilter"
                   wire:model.debounce.500ms="dateFilter"
                   class="form-control"
                   placeholder="Filtruj po dacie">
        </div>
        <div class="col-md-6">
            <label for="textFilter" class="form-label">Filtruj po nazwie drużyny:</label>
            <input type="text"
                   id="textFilter"
                   wire:model.debounce.300ms="textFilter"
                   class="form-control"
                   placeholder="Wpisz nazwę drużyny (np. Real, Valencia)">
        </div>
    </div>

    <!-- Loading state -->
    <div wire:loading class="alert alert-info d-flex align-items-center">
        <div class="spinner-border spinner-border-sm me-2" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        Ładowanie danych...
    </div>

    <!-- Tabela -->
    <div wire:loading.remove>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th wire:click="sortBy('date')" style="cursor: pointer" class="sortable">
                        Data
                        @if($sortBy === 'date')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @else
                            <i class="fas fa-sort ms-1 text-muted"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('home_team_name')" style="cursor: pointer" class="sortable">
                        Gospodarz
                        @if($sortBy === 'home_team_name')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @else
                            <i class="fas fa-sort ms-1 text-muted"></i>
                        @endif
                    </th>
                    <th wire:click="sortBy('away_team_name')" style="cursor: pointer" class="sortable">
                        Gość
                        @if($sortBy === 'away_team_name')
                            <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ms-1"></i>
                        @else
                            <i class="fas fa-sort ms-1 text-muted"></i>
                        @endif
                    </th>
                    <th>Wynik</th>
                    <th>Liga</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matches as $match)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ \Carbon\Carbon::parse($match->date)->format('d.m.Y') }}</div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($match->date)->format('H:i') }}</small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($match->home_team_logo)
                                    <img src="{{ $match->home_team_logo }}" alt="{{ $match->home_team_name }}" class="me-2" style="width: 20px; height: 20px;">
                                @endif
                                <span>{{ $match->home_team_name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($match->away_team_logo)
                                    <img src="{{ $match->away_team_logo }}" alt="{{ $match->away_team_name }}" class="me-2" style="width: 20px; height: 20px;">
                                @endif
                                <span>{{ $match->away_team_name }}</span>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary fs-6">
                                {{ $match->goals_home ?? '?' }} - {{ $match->goals_away ?? '?' }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($match->league_logo)
                                    <img src="{{ $match->league_logo }}" alt="{{ $match->league_name }}" class="me-2" style="width: 16px; height: 16px;">
                                @endif
                                <small>{{ $match->league_name }}</small>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <div class="text-muted">
                                <i class="fas fa-futbol fa-2x mb-2"></i>
                                <div>Brak meczów do wyświetlenia</div>
                                @if($textFilter || $dateFilter)
                                    <small>Sprawdź filtry lub wyczyść je aby zobaczyć wszystkie mecze</small>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
.sortable:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
}
</style>
