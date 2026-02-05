<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top navbar-custom">
    <div class="container">
        <a class="navbar-brand brand-custom" href="{{ url('/') }}">
            <i class="bi bi-basket2-fill brand-icon"></i>
            <span class="brand-text">FoodKP</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto ms-lg-4">
                {{-- HANYA TAMPIL JIKA SUDAH LOGIN --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('home.user') }}">
                            <i class="bi bi-house-door me-1"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="{{ route('menu.all') }}">
                            <i class="bi bi-grid me-1"></i>
                            <span>Menu Makanan</span>
                        </a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ms-auto align-items-lg-center">
                @guest
                    {{-- TAMPILAN JIKA BELUM LOGIN (GUEST) --}}
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link nav-link-custom" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right me-1"></i>
                                {{ __('Login') }}
                            </a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary-nav" href="{{ route('register') }}">
                                <i class="bi bi-person-plus me-1"></i>
                                {{ __('Daftar') }}
                            </a>
                        </li>
                    @endif
                @else
                    {{-- TAMPILAN JIKA SUDAH LOGIN (AUTH) --}}
                    <li class="nav-item me-lg-3">
                        <a class="nav-link nav-link-cart" href="{{ route('cart.index') }}">
                            <div class="cart-icon-wrapper">
                                <i class="bi bi-cart3"></i>
                                <span class="cart-badge">0</span>
                            </div>
                            <span class="d-lg-none ms-2">Keranjang</span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle user-dropdown" href="#" role="button"
                            data-bs-toggle="dropdown">
                            <div class="user-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-custom">
                            <li class="dropdown-header">
                                <div class="user-info">
                                    <div class="user-avatar-large">
                                        <i class="bi bi-person-circle"></i>
                                    </div>
                                    <div class="user-details">
                                        <strong>{{ Auth::user()->name }}</strong>
                                        <small class="text-muted d-block">{{ Auth::user()->email }}</small>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="{{ route('home.user') }}">
                                    <i class="bi bi-house-door me-2"></i>
                                    Beranda
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="{{ route('cart.index') }}">
                                    <i class="bi bi-cart3 me-2"></i>
                                    Keranjang Saya
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <i class="bi bi-clock-history me-2"></i>
                                    Riwayat Pesanan
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-custom" href="#">
                                    <i class="bi bi-gear me-2"></i>
                                    Pengaturan
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item dropdown-item-logout" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<!-- Spacer untuk fixed navbar -->
<div style="height: 76px;"></div>

<style>
    /* ===== NAVBAR VARIABLES ===== */
    :root {
        --navbar-height: 76px;
        --primary-color: #0d6efd;
        --primary-dark: #0a58ca;
        --navbar-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ===== MAIN NAVBAR ===== */
    .navbar-custom {
        box-shadow: var(--navbar-shadow);
        backdrop-filter: blur(10px);
        background: rgba(255, 255, 255, 0.95) !important;
        transition: var(--transition);
        padding: 0.75rem 0;
        z-index: 1030;
    }

    .navbar-custom.scrolled {
        padding: 0.5rem 0;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    }

    /* ===== BRAND ===== */
    .brand-custom {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        transition: var(--transition);
        font-weight: 800;
        font-size: 1.5rem;
    }

    .brand-icon {
        color: var(--primary-color);
        font-size: 2rem;
        transition: var(--transition);
    }

    .brand-text {
        color: #212529;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .brand-custom:hover .brand-icon {
        transform: rotate(15deg) scale(1.1);
    }

    /* ===== NAV LINKS ===== */
    .nav-link-custom {
        color: #495057 !important;
        font-weight: 600;
        padding: 0.5rem 1rem !important;
        border-radius: 8px;
        transition: var(--transition);
        position: relative;
        display: flex;
        align-items: center;
    }

    .nav-link-custom i {
        font-size: 1.1rem;
        transition: var(--transition);
    }

    .nav-link-custom:hover {
        color: var(--primary-color) !important;
        background: rgba(13, 110, 253, 0.08);
    }

    .nav-link-custom:hover i {
        transform: translateY(-2px);
    }

    .nav-link-custom.active {
        color: var(--primary-color) !important;
        background: rgba(13, 110, 253, 0.1);
    }

    /* ===== CART ICON ===== */
    .nav-link-cart {
        color: #495057 !important;
        padding: 0.5rem 1rem !important;
        border-radius: 8px;
        transition: var(--transition);
        position: relative;
        display: flex;
        align-items: center;
    }

    .cart-icon-wrapper {
        position: relative;
        display: inline-block;
    }

    .cart-icon-wrapper i {
        font-size: 1.5rem;
        transition: var(--transition);
    }

    .cart-badge {
        position: absolute;
        top: -8px;
        right: -10px;
        background: linear-gradient(135deg, #ff4757 0%, #e84118 100%);
        color: white;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 20px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(255, 71, 87, 0.4);
        animation: pulse-badge 2s infinite;
    }

    @keyframes pulse-badge {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    .nav-link-cart:hover {
        background: rgba(13, 110, 253, 0.08);
        color: var(--primary-color) !important;
    }

    .nav-link-cart:hover .cart-icon-wrapper i {
        transform: translateY(-3px);
    }

    /* ===== PRIMARY BUTTON (Daftar) ===== */
    .btn-primary-nav {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary-nav:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        color: white;
    }

    /* ===== USER DROPDOWN ===== */
    .user-dropdown {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 0.4rem 1rem !important;
        border-radius: 50px;
        border: 2px solid transparent;
        transition: var(--transition);
        color: #495057 !important;
        font-weight: 600;
    }

    .user-dropdown:hover {
        background: rgba(13, 110, 253, 0.08);
        border-color: rgba(13, 110, 253, 0.2);
        color: var(--primary-color) !important;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.2rem;
    }

    .user-name {
        max-width: 120px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ===== DROPDOWN MENU ===== */
    .dropdown-custom {
        border: none;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        border-radius: 16px;
        padding: 0;
        margin-top: 12px;
        min-width: 280px;
        animation: slideDown 0.3s ease-out;
        overflow: hidden;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-header {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        padding: 1.25rem;
        border: none;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .user-avatar-large {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        flex-shrink: 0;
    }

    .user-details {
        color: white;
        flex: 1;
    }

    .user-details strong {
        display: block;
        font-size: 1rem;
        margin-bottom: 2px;
    }

    .user-details small {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.8rem;
    }

    .dropdown-divider {
        margin: 0;
        border-color: rgba(0, 0, 0, 0.08);
    }

    .dropdown-item-custom {
        padding: 0.75rem 1.25rem;
        color: #495057;
        font-weight: 500;
        transition: var(--transition);
        display: flex;
        align-items: center;
    }

    .dropdown-item-custom i {
        width: 20px;
        font-size: 1.1rem;
        color: var(--primary-color);
        transition: var(--transition);
    }

    .dropdown-item-custom:hover {
        background: rgba(13, 110, 253, 0.08);
        color: var(--primary-color);
        padding-left: 1.5rem;
    }

    .dropdown-item-custom:hover i {
        transform: translateX(3px);
    }

    .dropdown-item-logout {
        padding: 0.75rem 1.25rem;
        color: #dc3545;
        font-weight: 600;
        transition: var(--transition);
        display: flex;
        align-items: center;
    }

    .dropdown-item-logout i {
        width: 20px;
        font-size: 1.1rem;
        transition: var(--transition);
    }

    .dropdown-item-logout:hover {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        padding-left: 1.5rem;
    }

    .dropdown-item-logout:hover i {
        transform: translateX(3px);
    }

    /* ===== MOBILE RESPONSIVE ===== */
    @media (max-width: 991px) {
        .navbar-custom {
            padding: 0.5rem 0;
        }

        .navbar-collapse {
            margin-top: 1rem;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .nav-link-custom,
        .nav-link-cart {
            padding: 0.75rem 1rem !important;
            margin: 0.25rem 0;
        }

        .btn-primary-nav {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 0.5rem;
        }

        .user-dropdown {
            padding: 0.75rem 1rem !important;
            border-radius: 8px;
            justify-content: space-between;
        }

        .dropdown-custom {
            margin-top: 0.5rem;
            box-shadow: none;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .cart-badge {
            top: -5px;
            right: -5px;
        }
    }

    /* ===== NAVBAR TOGGLER ===== */
    .navbar-toggler {
        padding: 0.5rem;
        border-radius: 8px;
        transition: var(--transition);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    }

    .navbar-toggler:hover {
        background: rgba(13, 110, 253, 0.08);
    }

    /* ===== SCROLL BEHAVIOR ===== */
    @media (min-width: 992px) {
        .navbar-custom.navbar-scrolled {
            padding: 0.5rem 0;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Navbar scroll effect
        const navbar = document.querySelector('.navbar-custom');

        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Highlight active nav link
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.nav-link-custom');

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            }
        });

        // Update cart badge (example - connect to your actual cart count)
        function updateCartBadge() {
            const cartBadge = document.querySelector('.cart-badge');
            if (cartBadge) {
                // Replace this with actual cart count from your backend
                const cartCount = 0; // Get from your cart system
                cartBadge.textContent = cartCount;

                if (cartCount > 0) {
                    cartBadge.style.display = 'block';
                } else {
                    cartBadge.style.display = 'none';
                }
            }
        }

        updateCartBadge();

        // Auto-close mobile menu on link click
        const navbarCollapse = document.querySelector('.navbar-collapse');
        const navLinks2 = document.querySelectorAll('.nav-link');

        navLinks2.forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 992) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: false
                    });
                    bsCollapse.hide();
                }
            });
        });
    });
</script>
