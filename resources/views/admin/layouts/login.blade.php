<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Vision'))</title>
    @vite(['resources/sass/app.scss'])
    <link href="{{ asset('assets/css/vendor.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    @yield('styles')
</head>

<body data-url="{{ route('admin.dashboard') }}" data-language="{{ $admin_language ?? 'en' }}"
    data-user="{{ $user_id ?? '0' }}">
    <div class="admin-login-layout" >
        {{-- {{ asset('images/bg-image.png') }} --}}
        @yield('content')
        <footer class="footer">{{ __('message.footer') }}</footer>
    </div>
    @yield('script')
</body>

</html>
