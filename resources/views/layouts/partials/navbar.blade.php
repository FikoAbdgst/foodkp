<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-basket2-fill text-primary me-2 fs-4"></i>
            <span class="fw-bold fs-4">Food<span class="text-primary">KP</span></span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#mengapa-kami">Mengapa Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}#rekomendasi">Menu</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="{{ route('home.user') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.user') }}#menu-user">Menu</a>
                    </li>
                @endguest
            </ul>

            <ul class="navbar-nav ms-auto align-items-center">
                @guest
                    <li class="nav-item me-2">
                        <a class="nav-link fw-semibold" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary rounded-pill px-4" href="{{ route('register') }}">
                            <i class="bi bi-person-plus"></i> Daftar
                        </a>
                    </li>
                @else
                    <li class="nav-item me-3">
                        <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart3 fs-5"></i>
                            @php
                                $cart = session()->get('cart', []);
                                $cartCount = array_sum(array_column($cart, 'quantity'));
                            @endphp
                            @if ($cartCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                    style="font-size: 0.65rem;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                            role="button" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-2">
                                <i class="bi bi-person-fill text-primary"></i>
                            </div>
                            <span class="fw-semibold">{{ Auth::user()->name }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <a class="dropdown-item" href="{{ route('cart.index') }}">
                                <i class="bi bi-cart3 me-2"></i> Keranjang Saya
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
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
