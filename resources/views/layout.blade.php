<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bitroidCalendarEv.css') }}">

    <script src="{{ asset('js/mobile.js') }}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>
    <script src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('js/moment-with-locales.min.js') }}" defer></script>
    <script src="{{ asset('js/bitroidCalendarEv.js') }}" defer></script>
    <script src="{{ asset('js/calendar.js') }}" defer></script>

    @yield('head')
</head>

<body>
    @if (Auth::check())
    <header class="header">
        <div class="container">
            <div class="header__body">

                <a class="logo" href="{{ route('home.index') }}">
                    <img src="{{ asset('uploads/public/images/icons/nav-icon.svg') }}" alt="logo">
                </a>

                {{-- <nav>
                    <ul class="nav__links">
                    </ul>
                </nav> --}}

                <form class="cta" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link class="logout" :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">Выход</x-responsive-nav-link>
                </form>

                <p class="menu cta">Меню</p>

            </div>
        </div>
    </header>

        <div class="overlay">
            <a class="close">
                <ion-icon class="close" name="close-outline">&times;</ion-icon>
            </a>
            <div class="overlay__content">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">Выход</x-responsive-nav-link>
                </form>
            </div>
        </div>
    @else
        <header class="header">
            <div class="container">
                <div class="header__body">
                    
                    <a class="logo" href="{{ route('home.index') }}">
                        <img src="{{ asset('uploads/public/images/icons/nav-icon.svg') }}" alt="logo">
                    </a>

                    <nav>
                        <ul class="nav__links">
                            <li><a href="{{ route('login') }}">Вход</a></li>
                        </ul>
                    </nav>

                    <div class="menu cta">Меню</div>
                
                </div>
            </div>
        </header>

        <div class="overlay">
            <a class="close">
                <ion-icon class="close" name="close-outline">&times;</ion-icon>
            </a>
            <div class="overlay__content">
                <a href="{{ route('login') }}">Вход</a>
            </div>
        </div>
    @endif

    @yield('main_content')
</body>

</html>
