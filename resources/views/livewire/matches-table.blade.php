<div>
    <!-- Filtrowanie po dacie -->
    <div class="mb-3">
        <input type="date"
               wire:model.debounce.500ms="dateFilter"
               class="form-control"
               placeholder="Filtruj po dacie">
    </div>

    <!-- Loading state -->
    <div wire:loading class="alert alert-info">
        Ładowanie danych...
    </div>

    <!-- Tabela -->
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th wire:click="sortBy('date')" style="cursor: pointer">
                    Data
                    @if($sortBy === 'date')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </th>
                <th wire:click="sortBy('home_team')" style="cursor: pointer">
                    Gospodarz
                    @if($sortBy === 'home_team')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </th>
                <th wire:click="sortBy('away_team')" style="cursor: pointer">
                    Gość
                    @if($sortBy === 'away_team')
                        {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                    @endif
                </th>
                <th>Wynik</th>
            </tr>
        </thead>
        <tbody>
            @forelse($matches as $match)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($match->date)->format('d.m.Y H:i') }}</td>
                    <td>{{ $match->home_team }}</td>
                    <td>{{ $match->away_team }}</td>
                    <td>{{ $match->home_score }} - {{ $match->away_score }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Brak meczów</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
