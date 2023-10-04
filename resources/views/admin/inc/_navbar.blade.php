<nav class="navbar navbar-expand-lg bg-body-tertiary d-print-none">
    <div class="container-fluid">
        <nav class="" aria-label="breadcrumb">
            @yield('breadcrumb')
        </nav>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height:100px">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('names.login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('names.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle no-arrow" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="welcome-message">
                                <i class='bx bx-bell bx-sm text-primary'></i>
                            </div>
                        </a>
                        <ul class="dropdown-menu notifications-dropdown px-0 py-1 " data-bs-popper="static">
                            @forelse(auth()->user()->unreadNotifications()->limit(5)->get() as $k => $notification)
                                <li>
                                    <a class="notification-card unread" href="{{ $notification->data['url'] ?? '#' }}">
                                        <div class="content">
                                            <div class="title">
                                                {{ $notification->data['from'] ?? config('app.name', 'Vision') }}</div>
                                            <div class="">
                                                {{ \Illuminate\Support\Str::limit($notification->data['message'], 25) }}
                                            </div>
                                        </div>
                                        <div class="time">
                                            <div>2023/5</div>
                                            <div>{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                </li>
                            @empty
                            @endforelse
                            <li>
                                <a class="show-all-notifications"
                                    href="{{ route('admin.notifications') }}">@lang('names.all-notifications')</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="user-img">
                                <img src="{{ Auth::user()->avatar ?? 'https://cdn.pixabay.com/photo/2020/07/01/12/58/icon-5359554_640.png' }}"
                                    alt="">
                            </div>
                            <div class="welcome-message">
                                {{ __('welcome ') . Auth::user()->name }}
                            </div>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" data-bs-popper="static"
                            aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('names.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
