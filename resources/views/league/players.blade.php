@extends('layouts.app2')

@section('content')
    <div class="container">
        <section class="mx-auto my-5" style="max-width: 23rem;">
            @foreach($players as $player)
                <div class="card testimonial-card mt-2 mb-3">
                    <div class="card-up aqua-gradient"></div>
                    <div class="avatar mx-auto white">
                        <img src="{{ asset($player->photo) }}" class="rounded-circle img-fluid"
                             alt="woman avatar">
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title font-weight-bold">{{ $player->name }}</h4>
                        <hr>
                        <p><i class="fas fa-quote-left"></i> {{ $player->position }}</p>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
