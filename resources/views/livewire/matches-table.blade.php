<div>
    <!-- Filtrowanie i sortowanie -->
    <div class="row mb-4">
        <div class="col-md-8">
            <label for="textFilter" class="form-label">Szukaj drużyny:</label>
            <input type="text"
                   id="textFilter"
                   wire:model.live.debounce.300ms="textFilter"
                   class="form-control"
                   placeholder="Wpisz nazwę drużyny (np. Real, Barcelona, Valencia)">
        </div>
        <div class="col-md-4">
            <label class="form-label">Sortuj po dacie:</label>
            <div class="btn-group w-100" role="group">
                <button type="button" 
                        wire:click="sortOldest" 
                        class="btn {{ $sortBy === 'date' && $sortDirection === 'asc' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Najstarsze
                </button>
                <button type="button" 
                        wire:click="sortNewest" 
                        class="btn {{ $sortBy === 'date' && $sortDirection === 'desc' ? 'btn-primary' : 'btn-outline-primary' }}">
                    Najnowsze
                </button>
            </div>
        </div>
    </div>

    <!-- Loading state - Barcelona themed -->
    <div wire:loading class="alert alert-primary border-0 shadow-sm">
        <div class="d-flex align-items-center justify-content-center py-4">
            <div class="me-4">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Ładowanie...</span>
                </div>
            </div>
            <div class="text-center">
                <h5 class="mb-2 text-primary">
                    <i class="fas fa-futbol me-2"></i>
                    FC Barcelona
                </h5>
                <p class="mb-1 fw-medium">Ładowanie meczów...</p>
                <small class="text-muted">Més que un club</small>
            </div>
        </div>
    </div>

    <!-- Kartki z meczami - 2 w rzędzie -->
    <div wire:loading.remove>
        <div class="row">
            @forelse($matches as $match)
                <div class="col-md-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <small><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($match->date)->format('d.m.Y') }}</small>
                                <small><i class="fas fa-clock me-1"></i>{{ \Carbon\Carbon::parse($match->date)->format('H:i') }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Drużyny -->
                            <div class="row align-items-center mb-3">
                                <div class="col-5 text-center">
                                    @if($match->home_team_logo)
                                        <img src="{{ $match->home_team_logo }}" alt="{{ $match->home_team_name }}" class="mb-2" style="width: 50px; height: 50px; object-fit: contain;">
                                    @endif
                                    <div class="fw-bold">{{ $match->home_team_name }}</div>
                                    <small class="text-muted">Gospodarz</small>
                                </div>
                                <div class="col-2 text-center">
                                    <div class="badge bg-primary fs-5 px-3 py-2">
                                        {{ $match->goals_home ?? '?' }} - {{ $match->goals_away ?? '?' }}
                                    </div>
                                </div>
                                <div class="col-5 text-center">
                                    @if($match->away_team_logo)
                                        <img src="{{ $match->away_team_logo }}" alt="{{ $match->away_team_name }}" class="mb-2" style="width: 50px; height: 50px; object-fit: contain;">
                                    @endif
                                    <div class="fw-bold">{{ $match->away_team_name }}</div>
                                    <small class="text-muted">Gość</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <div class="d-flex align-items-center justify-content-center">
                                @if($match->league_logo)
                                    <img src="{{ $match->league_logo }}" alt="{{ $match->league_name }}" class="me-2" style="width: 20px; height: 20px; object-fit: contain;">
                                @endif
                                <small class="text-muted fw-medium">{{ $match->league_name }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center py-5">
                        <i class="fas fa-search fa-3x mb-3 text-primary"></i>
                        <h4>Brak meczów do wyświetlenia</h4>
                        @if($textFilter)
                            <p class="mb-3">Nie znaleziono meczów dla frazy: <strong>"{{ $textFilter }}"</strong></p>
                            <small class="text-muted">Spróbuj wyszukać inną drużynę lub wyczyść filtr</small>
                        @else
                            <p class="text-muted">Brak meczów w bazie danych</p>
                        @endif
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        border: none;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .btn-group .btn {
        transition: all 0.2s ease;
    }
    
    .card-header {
        background: linear-gradient(135deg, #004d9f 0%, #a50044 100%);
    }
    
    /* Barcelona themed loading */
    .alert-primary {
        background: linear-gradient(135deg, #004d9f 0%, #a50044 100%);
        color: white;
        border: none;
    }
    
    .spinner-border {
        border-color: #fcb900;
        border-right-color: transparent;
        animation: spinner-border 0.75s linear infinite;
    }
    
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    .text-primary {
        color: #fcb900 !important;
    }
    </style>
</div>