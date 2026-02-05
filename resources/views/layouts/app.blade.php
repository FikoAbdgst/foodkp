<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'FoodKP') }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/app.css'])

    <style>
        :root {
            --primary-blue: #4A90E2;
            --dark-blue: #2C5F8D;
            --light-blue: #E8F4F8;
            --sidebar-bg: #2C3E50;
            --sidebar-hover: #34495E;
        }

        body {
            background-color: #F8F9FA;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        #sidebar {
            min-width: 260px;
            max-width: 260px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #1a252f 100%);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        #sidebar .sidebar-header {
            padding: 25px 20px;
            background: rgba(255, 255, 255, 0.05);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        #sidebar .sidebar-header h3 {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin: 0;
            letter-spacing: 0.5px;
        }

        #sidebar .sidebar-header p {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            margin: 5px 0 0 0;
        }

        .sidebar-menu {
            padding: 20px 0;
            flex: 1;
        }

        .sidebar-menu .menu-item {
            margin: 5px 15px;
        }

        .sidebar-menu .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .sidebar-menu .menu-item a:hover {
            background: var(--sidebar-hover);
            color: white;
            transform: translateX(5px);
        }

        .sidebar-menu .menu-item a.active {
            background: var(--primary-blue);
            color: white;
            box-shadow: 0 4px 10px rgba(74, 144, 226, 0.3);
        }

        .sidebar-menu .menu-item a i {
            font-size: 1.2rem;
            margin-right: 12px;
            width: 25px;
        }

        .sidebar-footer {
            padding: 20px 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: auto;
        }

        .sidebar-footer .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 15px;
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid rgba(231, 76, 60, 0.3);
            color: #E74C3C;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            cursor: pointer;
        }

        .sidebar-footer .logout-btn:hover {
            background: #E74C3C;
            color: white;
        }

        .sidebar-footer .logout-btn i {
            margin-right: 10px;
        }

        .content-area {
            flex: 1;
            padding: 30px;
            background-color: #F8F9FA;
            overflow-x: hidden;
        }

        .page-header {
            background: white;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .page-header h2 {
            color: var(--dark-blue);
            font-weight: 700;
            margin: 0;
        }

        .btn-primary {
            background: var(--primary-blue);
            border: none;
            padding: 10px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: var(--dark-blue);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        }
    </style>
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
