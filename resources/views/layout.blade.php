<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

    <script type="text/javascript" src="{{ asset('js/mobile.js') }}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" defer></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bitroidCalendarEv.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/moment-with-locales.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/bitroidCalendarEv.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/calendar.js') }}" defer></script>
    @yield('head')
</head>

<body>
    @if (Auth::check())
        <header>
            <a class="logo" href="{{ route('home.index') }}">
                <ion-icon name="planet-outline" alt="logo"></ion-icon>
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
        <header>
            <a class="logo" href="{{ route('home.index') }}">
                <ion-icon name="planet-outline" alt="logo"></ion-icon>
            </a>
            <nav>
                <ul class="nav__links">
                    <li><a href="{{ route('login') }}">Вход</a></li>
                </ul>
            </nav>
            <a class="cta" href="{{ route('register') }}">Регистрация</a>
            <p class="menu cta">Меню</p>
        </header>

        <div class="overlay">
            <a class="close">
                <ion-icon class="close" name="close-outline">&times;</ion-icon>
            </a>
            <div class="overlay__content">
                <a href="{{ route('login') }}">Вход</a>
                <a href="{{ route('register') }}">Регистрация</a>
            </div>
        </div>
    @endif

    @yield('main_content')
</body>

</html>
