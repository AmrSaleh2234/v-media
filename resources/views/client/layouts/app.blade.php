<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('client.inc._head')
</head>

<body>
<div id="app" class="layout">
    @include('client.inc._side')
    <div class="body-container">
        @include('client.inc._navbar')
        <main class="main-view">
        @yield('content')
        </main>
    </div>
</div>

@stack('script')

</body>

</html>

