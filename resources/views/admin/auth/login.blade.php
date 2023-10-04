@extends('admin.layouts.login')
@section('title')
    {{ __('Login') }}
@stop
@section('content')


    <div class="login-card">

        <div class="logo-container">
            <x-logo></x-logo>
        </div>
        <h2>{{ __('names.employee-gate') }}</h2>
        <form class="login-form form-group" role="form" method="POST" action="{{ route('admin.check') }}">
            @csrf
            <h4>{{ __('names.login') }}</h4>
            <label for="email">{{ __('message.login') }}</label>
            <div class="icon-input-container">
                <input type="email" class="form-control input-with-icon @error('email') is-invalid @enderror" required id="email"
                       name="email" placeholder="{{ __('names.enter-email') }}">
                <i class="input-icon bx bx-envelope"></i>
            </div>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="d-flex align-items-center flex-column">
                <button type="submit" class="btn btn-primary">{{ __('names.send-otp') }}</button>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </form>

    </div>
@stop
