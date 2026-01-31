<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])
</head>

<head>
    <style>
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        .content-area {
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="app">
        @auth
            @if (Auth::user()->role == 'admin')
                <div class="wrapper">
                    <nav id="sidebar" class="bg-dark text-white p-3">
                        <h3 class="text-center mb-4">FoodKP Admin</h3>
                        <ul class="nav flex-column">
                            <li class="nav-item mb-2">
                                <a href="{{ route('dashboard') }}"
                                    class="nav-link text-white {{ request()->is('home') ? 'active bg-primary' : '' }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item mb-2">
                                <a href="{{ route('foods.index') }}"
                                    class="nav-link text-white {{ request()->is('admin/foods*') ? 'active bg-primary' : '' }}">
                                    <i class="bi bi-egg-fried"></i> Kelola Makanan
                                </a>
                            </li>
                            <hr>
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="content-area p-4">
                        @yield('content')
                    </div>
                </div>
            @else
                @include('layouts.partials.navbar')
                <main class="py-4">
                    <div class="container">@yield('content')</div>
                </main>
            @endif
        @else
            @include('layouts.partials.navbar')
            <main>
                @yield('content')
            </main>
        @endauth
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</body>

</html>
