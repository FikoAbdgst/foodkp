<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/custom-styles.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    /* CSS Sidebar */
    :root {
        --sidebar-width: 260px;
        --primary-color: #4f46e5;
        --sidebar-bg: #ffffff;
        --sidebar-text: #4b5563;
        --sidebar-hover-bg: #f3f4f6;
        --sidebar-active-bg: #eef2ff;
        --sidebar-active-text: #4f46e5;
        --border-color: #e5e7eb;
    }

    body {
        font-family: 'Inter', sans-serif;
        background-color: #f9fafb;
        margin: 0;
    }

    /* Wrapper Layout */
    .wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
        min-height: 100vh;
    }

    /* Sidebar Styling */
    #sidebar {
        min-width: var(--sidebar-width);
        max-width: var(--sidebar-width);
        background: var(--sidebar-bg);
        color: var(--sidebar-text);
        border-right: 1px solid var(--border-color);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
        position: fixed;
        height: 100vh;
        z-index: 1000;
    }

    .sidebar-header {
        padding: 24px;
        border-bottom: 1px solid var(--border-color);
    }

    .sidebar-header h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .sidebar-header p {
        font-size: 0.85rem;
        color: #6b7280;
        margin: 0;
    }

    .sidebar-menu {
        padding: 16px 12px;
        flex-grow: 1;
        overflow-y: auto;
    }

    .menu-item {
        margin-bottom: 4px;
    }

    .menu-item a {
        padding: 12px 16px;
        font-size: 0.95rem;
        color: var(--sidebar-text);
        text-decoration: none;
        display: flex;
        align-items: center;
        border-radius: 8px;
        transition: all 0.2s;
        font-weight: 500;
    }

    .menu-item a i {
        margin-right: 12px;
        font-size: 1.2rem;
    }

    .menu-item a:hover {
        background: var(--sidebar-hover-bg);
        color: #111827;
    }

    .menu-item a.active {
        background: var(--sidebar-active-bg);
        color: var(--sidebar-active-text);
    }

    .sidebar-footer {
        padding: 16px;
        border-top: 1px solid var(--border-color);
    }

    .logout-btn {
        width: 100%;
        padding: 12px;
        background: #fee2e2;
        color: #dc2626;
        border: none;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-weight: 600;
        transition: background 0.2s;
        cursor: pointer;
    }

    .logout-btn:hover {
        background: #fecaca;
    }

    .content-area {
        width: 100%;
        padding: 30px;
        margin-left: var(--sidebar-width);
        min-height: 100vh;
        transition: all 0.3s;
    }

    @media (max-width: 768px) {
        #sidebar {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        .content-area {
            margin-left: 0;
        }
    }
</style>

<body>
    <div id="app">
        @auth
            @if (Auth::user()->role == 'admin')
                {{-- LAYOUT ADMIN --}}
                <div class="wrapper">
                    <nav id="sidebar">
                        <div class="sidebar-header">
                            <h3><i class="bi bi-shop"></i> Admin Panel</h3>
                            <p>Food Management System</p>
                        </div>

                        <div class="sidebar-menu">
                            <div class="menu-item">
                                <a href="{{ route('dashboard') }}"
                                    class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{ route('foods.index') }}"
                                    class="{{ request()->routeIs('foods.*') ? 'active' : '' }}">
                                    <i class="bi bi-egg-fried"></i> Kelola Menu
                                </a>
                            </div>
                            <div class="menu-item">
                                <a href="{{ route('stok.index') }}"
                                    class="{{ request()->routeIs('stok.*') ? 'active' : '' }}">
                                    <i class="bi bi-box-seam"></i> Kelola Stok
                                </a>
                            </div>
                        </div>

                        <div class="sidebar-footer">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="logout-btn">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </div>
                    </nav>

                    <div class="content-area">
                        {{-- Pesan Flash --}}
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        @yield('content')
                    </div>
                </div>
            @else
                {{-- LAYOUT USER BIASA --}}
                @include('layouts.partials.navbar')

                <main>
                    @yield('content')
                </main>
            @endif
        @else
            {{-- LAYOUT GUEST (BELUM LOGIN) --}}
            @if (!request()->routeIs('login') && !request()->routeIs('register'))
                @include('layouts.partials.navbar')
            @endif

            <main>
                @yield('content')
            </main>
        @endauth
    </div>
</body>

</html>
