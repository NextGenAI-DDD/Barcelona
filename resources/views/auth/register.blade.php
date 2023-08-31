@extends('layouts.app2')

@section('content')
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="storage/img/rejestracja.png"
                                             style="width: 150px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Zostań naszym Cules</h4>
                                    </div>

                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('firstName') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="firstName" autofocus>

                                                @error('firstName')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('surName') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('surName') is-invalid @enderror" name="surName" value="{{ old('surName') }}" required autocomplete="surName" autofocus>

                                                @error('surName')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Przydomek') }}</label>

                                            <div class="col-md-6">
                                                <input id="name" type="text" class="form-control @error('przydomek') is-invalid @enderror" name="przydomek" value="{{ old('przydomek') }}" required autocomplete="przydomek" autofocus>

                                                @error('przydomek')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                                            <div class="col-md-6">
                                                <input id="avatar" type="file" class="form-control" name="avatar">

                                            </div>
                                        </div>



                                        <div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-10 offset-md-4">
                                            <a class="btn btn-link" href="{{ route('login') }}">
                                                {{ __('LoginNew') }}
                                            </a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4 d-none d-sm-block">
                                    <h3 class="mb-4" style="color: yellow">Més que un club</h3>
                                    <p class="small mb-0">FC Barcelona, jest hiszpańskim klubem piłkarskim z siedzibą w Barcelonie. Klub został założony w 1899 roku i jest jednym z najbardziej utytułowanych zespołów na świecie.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
