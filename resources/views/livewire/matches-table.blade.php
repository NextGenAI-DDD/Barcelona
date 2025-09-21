<div>
    <!-- Tabela -->
    <div wire:loading.class="opacity-50">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Gospodarz</th>
                    <th>Gość</th>
                    <th>Wynik</th>
                    <th>Stadion</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matches as $match)
                    <tr>
                        <td>{{ $match['date'] }}</td>
                        <td>
                            <img src="{{ $match['home_team_logo'] }}" alt="logo" width="20">
                            {{ $match['home_team_name'] }}
                        </td>
                        <td>
                            <img src="{{ $match['away_team_logo'] }}" alt="logo" width="20">
                            {{ $match['away_team_name'] }}
                        </td>
                        <td>{{ $match['goals_home'] }} : {{ $match['goals_away'] }}</td>
                        <td>{{ $match['stadium'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Brak meczów</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Loading state -->
    <div wire:loading>
        <div class="alert alert-info">Ładowanie danych...</div>
    </div>
</div>
