@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="bg-gradient d-flex align-items-center bg-gradient shadow" style="background:#003472; height: 70px">
            <img class="d-flex align-items-center ms-1 m-0 fw-bold" src="https://media-1.api-sports.io/football/leagues/140.png" alt="la liga logo" style="height: 70px">
            <h1 class="d-flex align-items-center ms-3 justify-content-center m-0 fw-bold text-white" >{{ __("La Liga Table") }}</h1>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th>{{ __('Rank') }}</th>
                <th>{{ __('Team') }}</th>
                <th class="text-center">{{ __('Played') }}</th>
                <th class="text-center">{{ __('Win') }}</th>
                <th class="text-center">{{ __('Draw') }}</th>
                <th class="text-center">{{ __('Loss') }}</th>
                <th class="text-center">{{ __('GoalsFor') }}</th>
                <th class="text-center">{{ __('GoalsAgainst') }}</th>
                <th class="text-center">{{ __('GoalsDiff') }}</th>
                <th class="text-center">{{ __('Points') }}</th>
                <th>{{ __('Form') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($leagueTableData as $key => $team)
                <tr class="mb-4" style="{{ $key <= 3 ? 'border-left: 2px solid #4285F4;' : '' }} @if($key == 4) border-left: 2px solid #FA7B17; @elseif($key == 5) border-left: 2px solid #34A853; @elseif($key > 16) border-left: 2px solid #EA4335; @endif">
                    <td>{{ $team->rank }}.</td>
                    <td><img src="{{ asset($team->logo) }}" style="height: 20px" alt="logo"> {{ $team->team }}</td>
                    <td class="text-center">{{ $team->match_played }}</td>
                    <td class="text-center">{{ $team->win }}</td>
                    <td class="text-center">{{ $team->draw }}</td>
                    <td class="text-center">{{ $team->lose }}</td>
                    <td class="text-center">{{ $team->goals_for }}</td>
                    <td class="text-center">{{ $team->goals_against }}</td>
                    <td class="text-center">{{ $team->goals_diff }}</td>
                    <td class="text-center">{{ $team->points }}</td>
                    <td class="text-center">
                        <div class="d-flex">
                            @foreach(str_split(substr($team->form, -5)) as $character)
                                @if($character === 'W')
                                        <div class="bg-success bg-gradient text-white ms-1 shadow" style="width: 25px">
                                            <span class="fw-bold">{{ $character }}</span>
                                        </div>
                                @elseif($character === 'L')
                                        <div class="bg-danger bg-gradient text-white ms-1 shadow" style="width: 25px">
                                            <span class="fw-bold">{{ $character }}</span>
                                        </div>
                                @else
                                        <div class="bg-warning bg-gradient text-white ms-1 shadow" style="width: 25px">
                                            <span class="fw-bold">{{ $character }}</span>
                                        </div>
                                @endif
                            @endforeach
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
