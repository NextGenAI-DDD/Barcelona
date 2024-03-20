@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            @foreach($players as $player)
                <div class="col-sm-4">
                    <div class="card testimonial-card mt-2 mb-3">
                        <div class="card-up aqua-gradient">
                            <img src="{{ secure_asset('storage/img/herb.png') }}" style="width: 100px" alt="herb">
                            <div class="float-end me-3 mt-3"><h3 style="color: yellow">{{ $player->number }}</h3></div>

                        </div>
                        <div class="avatar mx-auto white">
                            <img src="{{ secure_asset($player->photo) }}" class="rounded-circle img-fluid"
                                 alt="woman avatar">
                        </div>
                        <div class="card-body text-center">
                            <h4 class="card-title font-weight-bold">{{ $player->name }}</h4>
                            <hr>
                            <p><i class="fas fa-quote-left"></i>@if($player->position == 'Attacker') {{ __('Attacker')}} @elseif($player->position == 'Midfielder') {{ __('Midfielder')}}@elseif($player->position == 'Defender') {{ __('Defender')}} @else {{ __('Goalkeeper')}} @endif</p>
                            <button data-bs-toggle="modal" data-bs-target="#playerStats" onclick="playerStats({{ $player }}, '{{ __(''.$player->playerStats->nationality) }}', '{{ $player->playerStats->getBirthDate() }}')">
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
        function playerStats(player, nationality, birthDate) {

                // Clear modal header and body
                $('#playerStatsLabel').empty();
                $('.playerStatsBody').empty();

                var playerStats = player.player_stats;

                //send information about player his data
                $('#playerStatsLabel').append(
                    player.name
                );

            var list = '<ul class="list-group list-group-flush">';
            if(birthDate != null)
            {
                list += '<li class="list-group-item"><i class="fa-solid fa-cake-candles"></i> Data urodzenia: '+ birthDate +'</li>';
            }
            if(playerStats.weight != null)
            {
                list += '<li class="list-group-item"><i class="fa-solid fa-weight-scale"></i> Waga: '+ playerStats.weight +'</li>';
            }
            if(playerStats.height != null)
            {
                list += '<li class="list-group-item"><i class="fa-solid fa-person"></i> Wzrost: '+ playerStats.height +'</li>';
            }
            if(nationality != null)
            {
                list += '<li class="list-group-item"><i class="fa-solid fa-flag"></i> Kraj: '+ nationality +'</li>';
            }

            list += '</ul>';

            $('.playerStatsBody').append(list);

        }
    </script>
@endpush
