<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link href="{{ asset('css/custom-styles.css') }}" rel="stylesheet">

    <!-- Google Fonts (Optional) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>
    <div id="app">
        @auth
            @if (Auth::user()->role == 'admin')
                <div class="wrapper">
                    <nav id="sidebar">
                        <div class="sidebar-header">
                            <h3><i class="bi bi-shop"></i> FoodKP</h3>
                            <p>Admin Panel</p>
                        </div>

                        <div class="sidebar-menu">
                            <div class="menu-item">
                                <a href="{{ route('dashboard') }}"
                                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="bi bi-speedometer2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </div>

                            @can('admin-access')
                                <div class="menu-item">
                                    <a href="{{ route('foods.index') }}"
                                        class="{{ request()->routeIs('foods.*') ? 'active' : '' }}">
                                        <i class="bi bi-egg-fried"></i>
                                        <span>Menu Makanan</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a href="{{ route('stok.index') }}"
                                        class="{{ request()->routeIs('stok.*') ? 'active' : '' }}">
                                        <i class="bi bi-box-seam"></i>
                                        <span>Kelola Stok</span>
                                    </a>
                                </div>
                            @endcan
                        </div>

                        <div class="sidebar-footer">
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </nav>

                    <div class="content-area">
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
</body>

</html>
