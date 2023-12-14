@extends('layouts.app')

@section('content')
    <div class="bg-contact100">
        <div class="container-contact100">
            <div class="wrap-contact100">
                <div class="contact100-pic js-tilt" data-tilt>
                    <img src="{{ asset('storage/img/mail.png') }}" alt="IMG">
                </div>
                <form class="contact100-form validate-form">
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="name" placeholder="{{ __('Name') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="{{ __('Email') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100">
                        <input class="input100" type="text" name="email" placeholder="{{ __('Title') }}">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa-solid fa-heading"></i>
                        </span>
                    </div>
                    <div class="wrap-input100">
                        <textarea class="input100" name="message" placeholder="{{ __('Message') }}"></textarea>
                        <span class="focus-input100"></span>
                    </div>
                    <div class="container-contact100-form-btn">
                        <button class="contact100-form-btn">
                            {{ __('Send') }} <img src="{{ asset('storage/img/herb.png') }}" alt="herb" style="width: 40px">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

