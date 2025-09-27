<div>
    <h3 class="mb-3">Mecze FC Barcelony</h3>

    {{-- Filtrowanie po dacie --}}
    <div class="mb-3">
        <label for="dateFilter" class="form-label">Filtruj od daty:</label>
        <input type="date" id="dateFilter" class="form-control"
               wire:model.debounce.500ms="dateFilter">
    </div>

    {{-- Loading --}}
    <div wire:loading class="alert alert-info">
        Ładowanie danych...
    </div>

    {{-- Tabela --}}
    <table class="table table-striped table-hover align-middle text-center">
        <thead class="table-dark">
            <tr>
                <th wire:click="sortBy('date')" style="cursor: pointer">
                    Data
                    @if ($sortBy === 'date')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th>Gospodarz</th>
                <th>Gość</th>
                <th wire:click="sortBy('league_name')" style="cursor: pointer">
                    Liga
                    @if ($sortBy === 'league_name')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
                <th wire:click="sortBy('goals_home')" style="cursor: pointer">
                    Wynik
                    @if ($sortBy === 'goals_home')
                        <span>{{ $sortDirection === 'asc' ? '↑' : '↓' }}</span>
                    @endif
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($matches as $match)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($match->date)->format('d.m.Y H:i') }}</td>
                    <td>
                        <img src="{{ $match->home_team_logo }}" alt="home" width="24">
                        {{ $match->home_team_name }}
                    </td>
                    <td>
                        <img src="{{ $match->away_team_logo }}" alt="away" width="24">
                        {{ $match->away_team_name }}
                    </td>
                    <td>{{ $match->league_name }}</td>
                    <td>{{ $match->goals_home }} - {{ $match->goals_away }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-muted">Brak meczów do wyświetlenia</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
