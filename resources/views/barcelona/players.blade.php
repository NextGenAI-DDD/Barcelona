@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @foreach($players as $player)
                @php
                    $playerStats = $player->playerStats;
                @endphp
                <div class="col-sm-4">
                    <div class="card testimonial-card mt-2 mb-3">
                        <div class="card-up aqua-gradient">
                            <img src="{{ asset('storage/img/herb.png') }}" style="width: 100px" alt="herb">
                            <div class="float-end me-3 mt-3"><h3 style="color: yellow">{{ $player->number }}</h3></div>
                        </div>
                        <div class="avatar mx-auto white">
                            <img src="{{ asset($player->photo) }}" class="rounded-circle img-fluid"
                                 alt="woman avatar">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title font-weight-bold">{{ $player->name }}</h4>
                            <hr>
                            <p><i class="fas fa-quote-left"></i>@if($player->position == 'Attacker') {{ __('Attacker')}} @elseif($player->position == 'Midfielder') {{ __('Midfielder')}}@elseif($player->position == 'Defender') {{ __('Defender')}} @else {{ __('Goalkeeper')}} @endif</p>
                            <button data-bs-toggle="modal" data-bs-target="#playerStats" onclick="playerStats({{ $player }})">
                                <i class="fa-solid fa-circle-info" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __("PlayerStats") }}"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

<!-- modal -->
        <div class="modal fade" id="playerStats" tabindex="-1" aria-labelledby="playerStats" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="playerStatsLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body playerStatsBody">

                    </div>
                </div>
            </div>
        </div>
@endsection
@push('scripts')
    <script>
        function playerStats(player) {
                var playerStats = player.player_stats
                // Clear modal header and body
                $('#playerStatsLabel').empty();
                $('.playerStatsBody').empty();

                console.log(playerStats, player)

                //send information about player his data
                $('#playerStatsLabel').append(
                    player.name
                );

            $('.playerStatsBody').append(
                '<ul class="list-group list-group-flush">' +
                    '<li class="list-group-item"><i class="fa-solid fa-cake-candles"></i> Data urodzenia:'+ playerStats.getBirthDate +'</li>' +
                    '<li class="list-group-item">Dapibus ac facilisis in</li>' +
                    '<li class="list-group-item">Morbi leo risus</li>' +
                    '<li class="list-group-item">Porta ac consectetur ac</li>' +
                    '<li class="list-group-item">Vestibulum at eros</li>' +
                '</ul>'
            );


            }
    </script>
@endpush
