<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title', config('app.name', 'Vision'))</title>

@vite(['resources/sass/app.scss', 'resources/js/app.js'])
<link href="{{ asset('assets/css/vendor.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
@yield('styles')
