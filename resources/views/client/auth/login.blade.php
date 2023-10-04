@extends('client.layouts.login')
@section('title')
    {{ __('Login') }}
@stop
@section('content')

    <div class="login-card">
        <div class="logo-container">
            <x-logo ></x-logo>
        </div>
        <h2>{{ __('names.client-gate') }}</h2>
        <form class="login-form form-group" role="form" method="POST" action="{{ route('client.check') }}">
            @csrf
            <h4>{{ __('names.login') }}</h4>
            <label for="email">{{ __('message.client-login') }}</label>
            <input type="text" class="form-control @error('card_id') is-invalid @enderror" required id="card_id"
                name="card_id" placeholder="{{ __('names.enter-card-id') }}">
            <i class="icon-sms" style="left:auto; !important"></i>

            @error('card_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            <div class="d-flex align-items-center flex-column">
                <button type="submit" class="btn btn-primary">{{ __('names.check-id') }}</button>
            </div>
        </form>
    </div>

@stop
