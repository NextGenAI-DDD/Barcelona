@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
            @foreach($games as $key=>$game)
                        <div class="col-sm-6 mb-3">
                            <div class="card text-center">
                                <div class="card-header">
                                    {{ $game->league_name }} - {{ __('Round') }} {{ $game->league_round }}
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="game-tab" data-bs-toggle="tab" href="#game{{$key}}">{{ __('Game') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="info-tab" data-bs-toggle="tab" href="#info{{$key}}">{{ __('Informations') }}</a>
                                        </li>
                                        <li class="nav-item ms-auto">
                                            <img src="{{ $game->league_logo }}" alt="logo" @if($game->league_logo == "https://media-4.api-sports.io/football/leagues/667.png") style="width: 50px" @else style="width: 30px" @endif >
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body tab-content">
                                    <div class="tab-pane fade show active" id="game{{$key}}">
                                        @if($game->getNowDate() > $game->date) <span>Zakończony</span> @endif
                                        <div class="d-flex justify-content-center">
                                            <div class="col-sm-4" style="margin-top: 35px"><img data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $game->home_team_name }}" src="{{ $game->home_team_logo }}" alt="{{ $game->home_team_name}}" style="width: 50px"></div>
                                            <div class="col-sm-1 mt-5 d-none d-sm-block"><h4>{{ $game->goals_home }}</h4></div>
                                            @if($game->goals_home !== null)
                                            <div class="col-sm-1 mt-5 d-md-none ms-4"><h4>{{ $game->goals_home }}</h4></div>
                                            @endif
                                            <div class="row col-sm-2 {{ $game->away_team_name == 'Juventus' ? 'me-1' : '' }}">
                                                <div class="col-sm-12"><p>{{ $game->getDate() }}</p></div>
                                                <div class="col-sm-12" style="margin-top: -20px!important;"><span>{{ $game->getTime() }}</span></div>
                                                <div class="col-sm-12" style="margin-top: -15px!important;"><h4>-</h4></div>
                                                @if($game->home_penalty != null)
                                                    <div class="col-sm-12"><span>({{ $game->home_penalty }} - {{ $game->away_penalty }})</span></div>
                                                @endif
                                            </div>
                                            <div class="col-sm-1 mt-5 d-none d-sm-block"><h4>{{ $game->goals_away }}</h4></div>
                                            @if($game->goals_away !== null)
                                                <div class="col-sm-1 mt-5 d-md-none me-4"><h4>{{ $game->goals_away }}</h4></div>
                                            @endif
                                            <div class="col-sm-4" style="margin-top: 35px"><img data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $game->away_team_name }}" src="{{ $game->away_team_logo }}" alt="{{ $game->away_team_name}}" @if($game->away_team_name == 'Juventus') style="width: 30px;" @else style="width: 50px;" @endif ></div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="info{{$key}}">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><h6><i class="fa-solid fa-earth-americas"></i> {{ __('Stadium') }}: {{ $game->stadium }}</h6></li>
                                            @if($game->referee != null)<li class="list-group-item"><h6><i class="fa-solid fa-person"></i> {{ __('Referee') }}: {{ $game->referee }}</h6></li>@endif
                                            <li class="list-group-item"><h6><i class="fa-solid fa-city"></i> {{ __('City') }}: {{ $game->city }}</h6></li>
                                            <li class="list-group-item"><h6><i class="fa-regular fa-calendar"></i> {{ __('Date') }}: {{ $game->getDate() }}</h6></li>
                                            <li class="list-group-item"><h6><i class="fa-regular fa-clock"></i> {{ __('Hour') }}: {{ $game->getTime() }}</h6></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endforeach
            </div>
        </div>
@endsection
