<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - FoodMarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-height: 100vh;
            width: 250px;
            transition: all 0.25s ease;
        }

        .sidebar-heading {
            padding: 0.875rem 1.25rem;
            font-size: 1.2rem;
        }

        .list-group-item {
            border: none;
            padding: 20px 30px;
        }

        .list-group-item.active {
            background-color: #ff4757;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        @auth
            <div class="bg-dark text-white" id="sidebar-wrapper">
                <div class="sidebar-heading fw-bold border-bottom border-secondary">🍔 Admin Food</div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('home') }}"
                        class="list-group-item list-group-item-action bg-dark text-white {{ request()->is('home') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('foods.index') }}"
                        class="list-group-item list-group-item-action bg-dark text-white {{ request()->is('admin/foods*') ? 'active' : '' }}">
                        <i class="bi bi-egg-fried me-2"></i> Kelola Makanan
                    </a>
                    <a href="/"
                        class="list-group-item list-group-item-action bg-dark text-white border-top border-secondary">
                        <i class="bi bi-shop me-2"></i> Lihat Toko
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="list-group-item list-group-item-action bg-dark text-danger w-100 text-start">
                            <i class="bi bi-box-arrow-left me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        @endauth

        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom px-4">
                <div class="container-fluid">
                    <a class="navbar-brand d-lg-none" href="/">🍔 FoodMarket</a>
                    <div class="ms-auto">
                        @auth
                            <span class="navbar-text me-3">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login Admin</a>
                        @endauth
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>
