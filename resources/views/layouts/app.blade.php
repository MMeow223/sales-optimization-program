<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>

    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        @if (Auth::guest())

        @else
        <nav id="theNavBar" class="navbar fixed-top navbar-expand-md navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto" id="navbarLinkList">
                        <li class="nav-item {{ (request()->is('/')) ? 'activeNavItem' : '' }}">
                            <a class="nav-link {{ (request()->is('/')) ? 'active' : '' }}" href="{{ url('/') }}">Dashboard</a>
                        </li>
                        <li class="nav-item {{ (request()->is('patients*')) ? 'activeNavItem' : '' }}">
                            <a class="nav-link {{ (request()->is('patients*')) ? 'active' : '' }}" href="{{ url('/patients') }}">Patients</a>
                        </li>
                        <li class="nav-item {{ (request()->is('pharmacies*')) ? 'activeNavItem' : '' }}">
                            <a class="nav-link {{ (request()->is('pharmacies*')) ? 'active' : '' }}" href="{{ url('/pharmacies') }}">Pharmacies</a>
                        </li>
                        <li class="nav-item {{ (request()->is('devices*')) ? 'activeNavItem' : '' }}">
                            <a class="nav-link {{ (request()->is('devices*')) ? 'active' : '' }}" href="{{ url('/devices') }}">Devices</a>
                        </li>
                        <li class="nav-item {{ (request()->is('exchanges*')) ? 'activeNavItem' : '' }}">
                            <a class="nav-link {{ (request()->is('exchanges*')) ? 'active' : '' }}" href="{{ url('/exchanges') }}">Control Exchange</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="py-4">
            <div class="container mt-5">
                @if (!Auth::guest())
                <div class="mt-3">
                    @include('inc.messages')
                </div>
                @yield('content')
                @else
                <div>
                    @include('inc.messages')
                </div>
                @yield('content')
                @endif

            </div>
        </main>
    </div>
</body>

</html>
