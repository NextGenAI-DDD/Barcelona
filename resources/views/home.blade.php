@extends('layouts.appHome')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('storage/img/stadiontlo.png') }}" alt="Image">
                    <div class="carousel-caption d-flex align-items-center">
                        <div class="container">
                            <div class="row align-items-center justify-content-center justify-content-lg-start">
                                <div class="col-10 col-lg-7 text-center text-lg-start d-none d-md-block">
                                    <h6 class="text-white text-uppercase mb-3 animated slideInDown">// Największa legenda klubowa //</h6>
                                    <h1 class="display-3 text-white mb-4 pb-3 animated slideInDown">Lionel Andrés Messi Cuccittini</h1>
                                </div>
                                <div class="col-lg-5 d-none d-lg-flex animated zoomIn">
                                    <img class="img-fluid" src="{{ asset('storage/img/messitlo.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Carousel End -->



@endsection

