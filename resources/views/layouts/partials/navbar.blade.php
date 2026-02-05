<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'FoodKP') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home.guest') }}">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cart.index') }}">
                        Keranjang
                        @if (session('cart'))
                            <span class="badge bg-danger">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            <span class="badge bg-secondary text-uppercase" style="font-size: 0.7rem;">
                                {{ Auth::user()->role }}
                            </span>
                        </a>

                        <div id="myDropdownMenu" class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            {{-- Menu Khusus Admin --}}
                            @if (Auth::user()->role == 'admin')
                                <a class="dropdown-item" href="{{ route('dashboard') }}">
                                    Dashboard Admin
                                </a>
                                <a class="dropdown-item" href="{{ route('foods.index') }}">
                                    Kelola Makanan
                                </a>
                                <div class="dropdown-divider"></div>
                            @endif

                            {{-- Menu Logout --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar {
        transition: all 0.3s;
    }

    .nav-link {
        transition: all 0.3s;
        position: relative;
    }

    .nav-link:hover {
        color: #0d6efd !important;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: #0d6efd;
        transition: all 0.3s;
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 80%;
    }

    .dropdown-menu {
        animation: fadeIn 0.3s;
    }

    /* Menangani tampilan dropdown saat aktif tanpa mengubah desain */
    .dropdown-menu.show {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        transition: all 0.3s;
    }

    .dropdown-item:hover {
        background-color: rgba(13, 110, 253, 0.1);
        padding-left: 2rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('navbarDropdown');
        const menu = document.getElementById('myDropdownMenu');

        if (toggle && menu) {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                menu.classList.toggle('show');
            });

            // Menutup dropdown jika klik di luar
            window.addEventListener('click', function(e) {
                if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('show');
                }
            });
        }
    });
</script>
