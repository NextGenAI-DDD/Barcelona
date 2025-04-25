@extends('layouts.app')

@section('content')
    <div class="bg-contact100">
        <div class="container-contact100">
            <div class="wrap-contact100">
                <div class="col-sm-12 d-md-none mx-auto" style="margin-top: -100px">
                    <img src="{{ asset('storage/img/herb.png') }}" alt="herb" style="width: 150px">
                </div>

                <div class="contact100-pic js-tilt" data-tilt>
                    <img src="{{ asset('storage/img/mail.png') }}" alt="IMG">
                </div>

                <form class="contact100-form validate-form" action="{{ route('send_mail') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="wrap-input100">
                        <input class="input100 @error('email') is-invalid @enderror" type="text" name="name" placeholder="{{ __('Name') }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100">
                        <input class="input100 @error('email') is-invalid @enderror" type="text" name="email" placeholder="{{ __('Email') }}" required>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100">
                        <input class="input100 @error('subject') is-invalid @enderror" type="text" name="subject" placeholder="{{ __('Subject') }}" required>
                        @error('subject')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa-solid fa-heading"></i>
                        </span>
                    </div>
                    <div class="wrap-input100">
                        <textarea class="input100 @error('message') is-invalid @enderror" name="message" placeholder="{{ __('Message') }}" required></textarea>
                        @error('message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn" id="contact_submit">
                            {{ __('Send') }} <img src="{{ asset('storage/img/herb.png') }}" alt="herb" style="width: 40px">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#contact_submit').click(function (){
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Wiadomość została wysłana",
                showConfirmButton: false,
                timer: 1500
            });
        })
    </script>
@endpush
