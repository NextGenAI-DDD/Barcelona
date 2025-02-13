@extends('layouts.app')

@section('content')
    <!-- Carousel Start -->
    <section class="carousel">
        <div class="container-fluid p-0 mb-5">
            <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="w-100" src="{{ asset('storage/img/stadion.jpg') }}" alt="Stadion">
                    </div>
                </div>
            </div>
        </div>
    </section>
        <!-- Carousel End -->
@endsection
