@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-gradient d-flex align-items-center bg-gradient shadow" style="background:#003472; height: 70px">
            <img class="d-flex align-items-center ms-1 m-0 fw-bold" src="https://media-1.api-sports.io/football/leagues/140.png" alt="la liga logo" style="height: 70px">
            <h1 class="d-flex align-items-center ms-3 justify-content-center m-0 fw-bold text-white" >{{ __("Top Scores") }}</h1>
        </div>

        <div class="table-container" style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th class="sticky-left">{{ __('Rank') }}</th>
                        <th class="sticky-left2">{{ __('Player') }}</th>
                        <th>{{ __('Team') }}</th>
                        <th class="text-center">{{ __('Games Appearances') }}</th>
                        <th class="text-center">{{ __('Games Minutes') }}</th>
                        <th class="text-center">{{ __('Games Position') }}</th>
                        <th class="text-center">{{ __('Goals') }}</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($topScores as $key => $player)
                        <tr class="mb-4">
                            <td class="sticky-left">{{ $key+1 }}.</td>
                            <td class="sticky-left2"><img src="{{ asset($player->photo) }}" style="height: 20px" alt="photo"> {{ $player->name }}</td>
                            <td><img src="{{ asset($player->club_logo) }}" style="height: 20px" alt="photo"> {{ $player->club_name }}</td>
                            <td class="text-center">{{ $player->games_appearances }}</td>
                            <td class="text-center">{{ $player->games_minutes }}</td>
                            <td class="text-center">@if($player->games_position == 'Attacker') {{ __('Attacker')}} @elseif($player->games_position == 'Midfielder') {{ __('Midfielder')}}@else {{ __('Defender')}} @endif</td>
                            <td class="text-center">{{ $player->goals }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection
