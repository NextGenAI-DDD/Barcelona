<div x-data="matchesTable({{ json_encode($matches) }})">
    <!-- Filtrowanie i sortowanie -->
    <div class="row mb-4">
        <div class="col-md-6">
            <label for="textFilter" class="form-label">
                <i class="fas fa-search me-1"></i>Szukaj drużyny:
            </label>
            <input type="text"
                   id="textFilter"
                   x-model="textFilter"
                   @input="filterMatches"
                   class="form-control"
                   placeholder="Wpisz nazwę drużyny (np. Real, Barcelona, Valencia)">
        </div>
        <div class="col-md-6">
            <label class="form-label">
                <i class="fas fa-sort me-1"></i>Sortowanie (JavaScript - błyskawiczne):
            </label>
            <div class="row">
                <div class="col-6">
                    <div class="btn-group w-100" role="group">
                        <button type="button" 
                                @click="sortMatches('date', 'asc')"
                                class="btn btn-sm"
                                :class="sortBy === 'date' && sortDirection === 'asc' ? 'btn-primary' : 'btn-outline-primary'">
                            <i class="fas fa-calendar-alt me-1"></i>Najstarsze
                        </button>
                        <button type="button" 
                                @click="sortMatches('date', 'desc')"
                                class="btn btn-sm"
                                :class="sortBy === 'date' && sortDirection === 'desc' ? 'btn-primary' : 'btn-outline-primary'">
                            <i class="fas fa-calendar-alt me-1"></i>Najnowsze
                        </button>
                    </div>
                </div>
                <div class="col-6">
                    <div class="dropdown">
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-sort-alpha-down me-1"></i>Więcej opcji
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li><a class="dropdown-item" href="#" @click="sortMatches('home_team_name', 'asc')">
                                <i class="fas fa-home me-2"></i>Drużyna gospodarza
                            </a></li>
                            <li><a class="dropdown-item" href="#" @click="sortMatches('away_team_name', 'asc')">
                                <i class="fas fa-plane me-2"></i>Drużyna gości
                            </a></li>
                            <li><a class="dropdown-item" href="#" @click="sortMatches('league_name', 'asc')">
                                <i class="fas fa-trophy me-2"></i>Liga
                            </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informacja o aktualnym sortowaniu -->
    <div class="alert alert-info border-0 py-2 mb-3">
        <small>
            <i class="fas fa-info-circle me-1"></i>
            Aktualnie sortowane po: <strong x-text="getSortLabel()"></strong>
            (<span x-text="sortDirection === 'asc' ? 'rosnąco' : 'malejąco'"></span>)
            - <span class="text-success"><i class="fas fa-lightning-bolt me-1"></i>JavaScript - natychmiastowe!</span>
        </small>
    </div>

    <!-- Kartki z meczami - 2 w rzędzie -->
    <div class="row">
        <template x-for="match in filteredMatches" :key="match.id">
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <small><i class="fas fa-calendar me-1"></i><span x-text="formatDate(match.date)"></span></small>
                            <small><i class="fas fa-clock me-1"></i><span x-text="formatTime(match.date)"></span></small>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Drużyny -->
                        <div class="row align-items-center mb-3">
                            <div class="col-5 text-center">
                                <img x-show="match.home_team_logo" :src="match.home_team_logo" :alt="match.home_team_name" class="mb-2" style="width: 50px; height: 50px; object-fit: contain;">
                                <div class="fw-bold" x-text="match.home_team_name"></div>
                                <small class="text-muted">Gospodarz</small>
                            </div>
                            <div class="col-2 text-center">
                                <div class="badge bg-primary fs-5 px-3 py-2">
                                    <span x-text="match.goals_home || '?'"></span> - <span x-text="match.goals_away || '?'"></span>
                                </div>
                            </div>
                            <div class="col-5 text-center">
                                <img x-show="match.away_team_logo" :src="match.away_team_logo" :alt="match.away_team_name" class="mb-2" style="width: 50px; height: 50px; object-fit: contain;">
                                <div class="fw-bold" x-text="match.away_team_name"></div>
                                <small class="text-muted">Gość</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center">
                        <div class="d-flex align-items-center justify-content-center">
                            <img x-show="match.league_logo" :src="match.league_logo" :alt="match.league_name" class="me-2" style="width: 20px; height: 20px; object-fit: contain;">
                            <small class="text-muted fw-medium" x-text="match.league_name"></small>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
        <!-- Komunikat gdy brak meczów -->
        <div x-show="filteredMatches.length === 0" class="col-12">
            <div class="alert alert-info text-center py-5">
                <i class="fas fa-search fa-3x mb-3 text-primary"></i>
                <h4>Brak meczów do wyświetlenia</h4>
                <p x-show="textFilter" class="mb-3">Nie znaleziono meczów dla frazy: <strong x-text="textFilter"></strong></p>
                <p x-show="!textFilter" class="text-muted">Brak meczów w bazie danych</p>
                <small x-show="textFilter" class="text-muted">Spróbuj wyszukać inną drużynę lub wyczyść filtr</small>
            </div>
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

    <script>
    function matchesTable(initialMatches) {
        return {
            allMatches: initialMatches,
            filteredMatches: initialMatches,
            textFilter: '',
            sortBy: 'date',
            sortDirection: 'asc',

            init() {
                this.filterMatches();
            },

            filterMatches() {
                let matches = [...this.allMatches];
                
                // Filtrowanie po tekście
                if (this.textFilter) {
                    matches = matches.filter(match => 
                        match.home_team_name.toLowerCase().includes(this.textFilter.toLowerCase()) ||
                        match.away_team_name.toLowerCase().includes(this.textFilter.toLowerCase())
                    );
                }
                
                // Sortowanie
                this.sortMatchesArray(matches);
                this.filteredMatches = matches;
            },

            sortMatches(field, direction) {
                this.sortBy = field;
                this.sortDirection = direction;
                this.filterMatches();
            },

            sortMatchesArray(matches) {
                matches.sort((a, b) => {
                    let aValue = a[this.sortBy] || '';
                    let bValue = b[this.sortBy] || '';

                    // Specjalne sortowanie dla różnych typów danych
                    switch (this.sortBy) {
                        case 'date':
                            aValue = new Date(aValue).getTime();
                            bValue = new Date(bValue).getTime();
                            break;
                        case 'goals_home':
                        case 'goals_away':
                            aValue = parseInt(aValue) || 0;
                            bValue = parseInt(bValue) || 0;
                            break;
                        case 'home_team_name':
                        case 'away_team_name':
                        case 'league_name':
                            aValue = aValue.toLowerCase();
                            bValue = bValue.toLowerCase();
                            break;
                    }

                    if (this.sortDirection === 'asc') {
                        return aValue < bValue ? -1 : aValue > bValue ? 1 : 0;
                    } else {
                        return aValue > bValue ? -1 : aValue < bValue ? 1 : 0;
                    }
                });
            },

            getSortLabel() {
                switch (this.sortBy) {
                    case 'date': return 'Data meczu';
                    case 'home_team_name': return 'Drużyna gospodarza';
                    case 'away_team_name': return 'Drużyna gości';
                    case 'league_name': return 'Liga';
                    default: return 'Nieznane';
                }
            },

            formatDate(dateString) {
                return new Date(dateString).toLocaleDateString('pl-PL');
            },

            formatTime(dateString) {
                return new Date(dateString).toLocaleTimeString('pl-PL', { 
                    hour: '2-digit', 
                    minute: '2-digit' 
                });
            }
        }
    }
    </script>
</div>