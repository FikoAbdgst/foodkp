@extends('layouts.app')

@section('content')
    <section class="hero-user-section">
        <div class="hero-user-bg"></div>
        <div class="floating-particles">
            <div class="particle particle-1"></div>
            <div class="particle particle-2"></div>
            <div class="particle particle-3"></div>
            <div class="particle particle-4"></div>
        </div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="hero-user-content">
                        <div class="welcome-badge mb-3">
                            <i class="bi bi-stars me-2"></i>
                            Selamat Datang Kembali
                        </div>
                        <h1 class="hero-user-title mb-3">
                            Halo, <span class="text-gradient">{{ Auth::user()->name }}</span>! 👋
                        </h1>
                        <p class="hero-user-subtitle mb-4">
                            Siap untuk menikmati makanan lezat hari ini? Pilih menu favorit Anda dan pesan sekarang juga!
                        </p>
                        <div class="hero-user-actions">
                            <a href="#menu-user" class="btn btn-primary-hero">
                                <i class="bi bi-arrow-down-circle me-2"></i>
                                Lihat Menu
                            </a>
                            <a href="{{ route('cart.index') }}" class="btn btn-outline-hero">
                                <i class="bi bi-cart3 me-2"></i>
                                Keranjang Saya
                            </a>
                        </div>


                    </div>
                </div>

                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left">
                    <div class="hero-user-illustration">
                        <div class="illustration-card card-1">
                            <i class="bi bi-emoji-smile-fill"></i>
                            <div>
                                <strong>Rating Kepuasan</strong>
                                <div class="rating-stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div class="illustration-card card-2">
                            <i class="bi bi-lightning-charge-fill"></i>
                            <div>
                                <strong>Pengiriman Cepat</strong>
                                <p class="mb-0 small">± 30 menit</p>
                            </div>
                        </div>
                        <div class="main-illustration">
                            <i class="bi bi-bag-heart-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-features-bar">
        <div class="container">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-bar-item">
                        <div class="feature-bar-icon bg-primary-light">
                            <i class="bi bi-lightning-fill text-primary"></i>
                        </div>
                        <div class="feature-bar-content">
                            <h6>Proses Cepat</h6>
                            <p>Pesan dalam hitungan menit</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-bar-item">
                        <div class="feature-bar-icon bg-success-light">
                            <i class="bi bi-shield-check text-success"></i>
                        </div>
                        <div class="feature-bar-content">
                            <h6>Aman & Terpercaya</h6>
                            <p>Transaksi terjamin 100%</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-bar-item">
                        <div class="feature-bar-icon bg-warning-light">
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <div class="feature-bar-content">
                            <h6>Kualitas Terbaik</h6>
                            <p>Bahan fresh setiap hari</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-bar-item">
                        <div class="feature-bar-icon bg-info-light">
                            <i class="bi bi-truck text-info"></i>
                        </div>
                        <div class="feature-bar-content">
                            <h6>Gratis Ongkir</h6>
                            <p>Minimal pembelian 50K</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section id="menu-user" class="menu-user-section">
        <div class="container">
            <div class="section-header-user" data-aos="fade-up">
                <div class="section-header-left">
                    <span class="section-subtitle">Untuk Anda</span>
                    <h2 class="section-title">Menu Rekomendasi</h2>
                    <p class="text-muted mt-2">Pilihan menu paling laris yang wajib Anda coba!</p>
                </div>
                <div class="section-header-right">
                    <span class="popular-badge-user">
                        <i class="bi bi-star-fill me-2"></i>
                        Top 3 Terlaris
                    </span>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success-custom" data-aos="fade-down" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4 mt-2 justify-content-center">
                @php
                    // LOGIKA BARU: Filter data foods, urutkan berdasarkan 'terjual' tertinggi, ambil maksimal 3
                    $topFoods = $foods->sortByDesc('terjual')->take(3);

                    // Mencari angka terjual tertinggi untuk label (jika diperlukan)
                    $maxTerjual = $foods->max('terjual');
                @endphp

                @forelse ($topFoods as $food)
                    @php
                        $terjual = $food->terjual ?? 0;

                        // Logika format angka terjual kelipatan 10++
                        $displayTerjual = $terjual;
                        if ($terjual >= 10) {
                            $displayTerjual = floor($terjual / 10) * 10 . '++';
                        }
                    @endphp

                    <div class="col-xl-4 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="menu-card h-100 border-0 shadow-sm">
                            <div class="menu-card-image position-relative overflow-hidden rounded-top-4">
                                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}"
                                    class="w-100 h-100 object-fit-cover">

                                <div class="menu-card-badges position-absolute top-0 end-0 p-3">
                                    <span
                                        class="badge-popular bg-white text-dark shadow-sm px-3 py-2 rounded-pill fw-bold">
                                        🔥
                                        Populer
                                    </span>
                                </div>

                                <div
                                    class="menu-card-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 opacity-0 hover-opacity-100 transition-all">
                                    <button class="btn-quick-view btn btn-light rounded-circle p-3" data-bs-toggle="modal"
                                        data-bs-target="#imageModal{{ $food->id }}" title="Perbesar Gambar">
                                        <i class="bi bi-zoom-in fs-5"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="menu-card-body p-4 d-flex flex-column bg-white rounded-bottom-4">
                                <h5 class="menu-card-title fw-bold text-dark mb-2">{{ $food->nama_makanan }}</h5>

                                <div class="menu-card-info mb-3">
                                    <span
                                        class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill">
                                        <i class="bi bi-bag-check-fill me-1"></i>
                                        Terjual {{ $displayTerjual }}
                                    </span>
                                </div>

                                <div class="menu-card-price-row mt-auto mb-4">
                                    <div class="d-flex flex-column">
                                        <small class="text-muted mb-1">Harga Spesial</small>
                                        <span class="fs-3 fw-bold text-primary">Rp
                                            {{ number_format($food->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#detailModal{{ $food->id }}">
                                    <i class="bi bi-cart-plus me-2"></i> Pesan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Image --}}
                    <div class="modal fade" id="imageModal{{ $food->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md">
                            <div class="modal-content bg-transparent border-0 shadow-none">
                                <div class="modal-body p-0 text-center position-relative">
                                    <button type="button"
                                        class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                                        data-bs-dismiss="modal" aria-label="Close" style="z-index: 1051;"></button>
                                    <div class="modal-image-container shadow-lg">
                                        <img src="{{ asset('storage/' . $food->image) }}" class="img-fluid rounded"
                                            alt="{{ $food->nama_makanan }}"
                                            style="max-height: 80vh; width: auto; object-fit: contain;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Detail --}}
                    <div class="modal fade" id="detailModal{{ $food->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 rounded-4 overflow-hidden">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title fw-bold">{{ $food->nama_makanan }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-4">
                                        <img src="{{ asset('storage/' . $food->image) }}"
                                            class="img-fluid rounded-4 shadow-sm"
                                            style="max-width: 100%; height: 250px; object-fit: cover;">
                                    </div>
                                    <div
                                        class="d-flex justify-content-between align-items-center mb-4 bg-light p-3 rounded-3">
                                        <div>
                                            <small class="text-muted d-block">Harga per porsi</small>
                                            <h4 class="text-primary fw-bold mb-0">Rp
                                                {{ number_format($food->harga, 0, ',', '.') }}</h4>
                                        </div>
                                        <div class="text-end">
                                            <small class="text-muted d-block">Total Terjual</small>
                                            <span class="fw-bold text-dark fs-5">
                                                <i class="bi bi-fire text-danger me-1"></i> {{ $displayTerjual }}
                                            </span>
                                        </div>
                                    </div>

                                    <p class="mb-2"><small class="text-muted">Stok Tersedia:</small> <strong
                                            class="stok-tersedia">{{ $food->stok }}</strong></p>

                                    <form action="{{ route('cart.add', $food->id) }}" method="POST"
                                        id="formAddCart{{ $food->id }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="qty{{ $food->id }}"
                                                class="form-label fw-bold small text-uppercase">Jumlah Pesanan</label>
                                            <div class="input-group">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="decrementQty({{ $food->id }})"><i
                                                        class="bi bi-dash"></i></button>
                                                <input type="number" name="quantity" id="qty{{ $food->id }}"
                                                    class="form-control text-center fw-bold" value="1"
                                                    min="1" max="{{ $food->stok }}">
                                                <button class="btn btn-outline-secondary" type="button"
                                                    onclick="incrementQty({{ $food->id }}, {{ $food->stok }})"><i
                                                        class="bi bi-plus"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer border-0 pt-0">
                                    <button type="button" class="btn btn-light rounded-pill px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" form="formAddCart{{ $food->id }}"
                                        class="btn btn-primary rounded-pill px-4 fw-bold shadow-sm"
                                        {{ $food->stok < 1 ? 'disabled' : '' }}>
                                        {{ $food->stok < 1 ? 'Stok Habis' : 'Masuk Keranjang' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-menu-state" data-aos="fade-up">
                            <div class="empty-icon text-muted opacity-25 mb-3">
                                <i class="bi bi-inbox fs-1"></i>
                            </div>
                            <h4>Belum Ada Data Rekomendasi</h4>
                            <p class="text-muted">Data menu akan muncul setelah ada transaksi pembelian.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if (count($foods) > 0)
                <div class="text-center mt-5" data-aos="fade-up">
                    <a href="{{ route('menu.all') }}" class="btn btn-primary-hero btn-lg">
                        <i class="bi bi-grid-3x3-gap me-2"></i>
                        Lihat Semua Menu
                    </a>
                </div>
            @endif
        </div>
    </section>

    <section class="why-choose-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Keunggulan Kami</span>
                <h2 class="section-title">Mengapa Pilih FoodKP?</h2>
                <p class="section-description">Komitmen kami untuk memberikan yang terbaik untuk Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-card">
                        <div class="why-icon-wrapper">
                            <div class="why-icon bg-primary-light">
                                <i class="bi bi-patch-check-fill text-primary"></i>
                            </div>
                        </div>
                        <h5>Bahan Berkualitas</h5>
                        <p>Menggunakan bahan segar pilihan terbaik yang disiapkan dengan higienis setiap hari</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="why-card">
                        <div class="why-icon-wrapper">
                            <div class="why-icon bg-success-light">
                                <i class="bi bi-wallet2 text-success"></i>
                            </div>
                        </div>
                        <h5>Harga Terjangkau</h5>
                        <p>Makan enak tidak harus mahal. Nikmati berbagai promo spesial setiap hari</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="why-card">
                        <div class="why-icon-wrapper">
                            <div class="why-icon bg-warning-light">
                                <i class="bi bi-lightning-charge-fill text-warning"></i>
                            </div>
                        </div>
                        <h5>Pengiriman Cepat</h5>
                        <p>Sistem logistik modern memastikan pesanan tiba cepat dan tetap hangat</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-user-section">
        <div class="container">
            <div class="footer-top">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand">
                            <i class="bi bi-basket2-fill"></i>
                            <span>FoodKP</span>
                        </div>
                        <p class="footer-description">
                            Solusi praktis untuk kebutuhan makanan Anda. Pesan dengan mudah, nikmati dengan senang hati.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="social-link"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-heading">Perusahaan</h5>
                        <ul class="footer-links">
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Karir</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Mitra</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-heading">Menu</h5>
                        <ul class="footer-links">
                            <li><a href="#menu-user">Menu Populer</a></li>
                            <li><a href="#">Semua Menu</a></li>
                            <li><a href="#">Promo</a></li>
                            <li><a href="#">Kategori</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-heading">Hubungi Kami</h5>
                        <ul class="footer-contact">
                            <li>
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Jl. Contoh No. 123, Bandung</span>
                            </li>
                            <li>
                                <i class="bi bi-envelope-fill"></i>
                                <span>info@foodkp.com</span>
                            </li>
                            <li>
                                <i class="bi bi-phone-fill"></i>
                                <span>+62 812-3456-789</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">&copy; 2026 FoodKP Development. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <style>
        /* ===== VARIABLES ===== */
        :root {
            --primary: #0d6efd;
            --primary-dark: #0a58ca;
            --primary-light: rgba(13, 110, 253, 0.1);
            --success: #198754;
            --success-light: rgba(25, 135, 84, 0.1);
            --warning: #ffc107;
            --warning-light: rgba(255, 193, 7, 0.1);
            --info: #0dcaf0;
            --info-light: rgba(13, 202, 240, 0.1);
            --dark: #212529;
            --light: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Agar Footer Sticky di Bawah */
        html,
        body {
            height: 100%;
        }

        #app {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* ===== HERO USER SECTION ===== */
        .hero-user-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 120px 0 80px;
            /* Tambahkan padding atas agar tidak tertutup navbar */
            position: relative;
            overflow: hidden;
        }

        .hero-user-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(13, 110, 253, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(13, 110, 253, 0.05) 0%, transparent 50%);
            z-index: 0;
        }

        .floating-particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            border-radius: 50%;
            opacity: 0.08;
            animation: float 15s infinite ease-in-out;
        }

        .particle-1 {
            width: 80px;
            height: 80px;
            background: var(--primary);
            top: 10%;
            left: 15%;
        }

        .particle-2 {
            width: 120px;
            height: 120px;
            background: var(--warning);
            top: 70%;
            right: 10%;
            animation-delay: 2s;
        }

        .particle-3 {
            width: 60px;
            height: 60px;
            background: var(--success);
            bottom: 20%;
            left: 60%;
            animation-delay: 4s;
        }

        .particle-4 {
            width: 100px;
            height: 100px;
            background: var(--info);
            top: 40%;
            right: 30%;
            animation-delay: 6s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-30px) rotate(180deg);
            }
        }

        .welcome-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            border: 2px solid rgba(13, 110, 253, 0.2);
        }

        .hero-user-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--dark);
            line-height: 1.2;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-user-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
            line-height: 1.8;
        }

        .hero-user-actions {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn-primary-hero {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.4);
            color: white;
        }

        .btn-outline-hero {
            background: white;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-hero:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
        }

        .user-quick-info {
            display: flex;
            gap: 30px;
            flex-wrap: wrap;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 16px 20px;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .info-item i {
            font-size: 2rem;
            color: var(--primary);
        }

        .info-item strong {
            display: block;
            font-size: 0.9rem;
            color: var(--dark);
        }

        .info-item p {
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* Hero Illustration */
        .hero-user-illustration {
            position: relative;
            height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-illustration {
            font-size: 250px;
            color: rgba(13, 110, 253, 0.08);
            animation: pulse 3s infinite ease-in-out;
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .illustration-card {
            position: absolute;
            background: white;
            padding: 16px 20px;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: floatCard 3s infinite ease-in-out;
            z-index: 2;
        }

        .illustration-card i {
            font-size: 2rem;
            color: var(--primary);
        }

        .illustration-card strong {
            display: block;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .illustration-card .rating-stars i {
            color: var(--warning);
            font-size: 0.8rem;
        }

        .card-1 {
            top: 15%;
            right: 5%;
        }

        .card-2 {
            bottom: 20%;
            left: 10%;
            animation-delay: 1.5s;
        }

        @keyframes floatCard {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        /* ===== QUICK FEATURES BAR ===== */
        .quick-features-bar {
            background: white;
            padding: 40px 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .feature-bar-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 20px;
            background: var(--light);
            border-radius: 16px;
            transition: var(--transition);
            height: 100%;
        }

        .feature-bar-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-md);
        }

        .feature-bar-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            flex-shrink: 0;
        }

        .bg-primary-light {
            background: var(--primary-light);
        }

        .bg-success-light {
            background: var(--success-light);
        }

        .bg-warning-light {
            background: var(--warning-light);
        }

        .bg-info-light {
            background: var(--info-light);
        }

        .feature-bar-content h6 {
            font-weight: 700;
            margin-bottom: 4px;
            color: var(--dark);
        }

        .feature-bar-content p {
            margin: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        /* ===== PROMO BANNER ===== */
        .promo-banner-section {
            padding: 40px 0;
        }

        .promo-banner {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border-radius: 24px;
            padding: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(13, 110, 253, 0.3);
        }

        .promo-banner::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -50px;
            right: -50px;
        }

        .promo-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            display: inline-block;
            margin-bottom: 12px;
        }

        .promo-content h3 {
            color: white;
            font-weight: 800;
            margin-bottom: 8px;
            font-size: 1.75rem;
        }

        .promo-content p {
            color: rgba(255, 255, 255, 0.95);
            margin: 0;
            font-size: 1.1rem;
        }

        .promo-content strong {
            background: rgba(255, 255, 255, 0.3);
            padding: 4px 12px;
            border-radius: 8px;
        }

        .promo-icon {
            font-size: 120px;
            color: rgba(255, 255, 255, 0.2);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* ===== MENU USER SECTION ===== */
        .menu-user-section {
            padding: 80px 0;
            background: var(--light);
        }

        .section-header-user {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .section-subtitle {
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.875rem;
            display: block;
            margin-bottom: 8px;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--dark);
            margin: 0;
        }

        .section-description {
            color: #6c757d;
            font-size: 1.1rem;
            margin-top: 8px;
        }

        .popular-badge-user {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.3);
        }

        /* Alert Custom */
        .alert-success-custom {
            background: linear-gradient(135deg, #d1f2eb 0%, #c3e6cb 100%);
            border: 2px solid #b1dfbb;
            color: #155724;
            padding: 16px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            animation: slideDown 0.5s ease-out;
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

        /* ===== MENU CARD ===== */
        .menu-card {
            transition: all 0.3s ease;
        }

        .menu-card:hover {
            transform: translateY(-10px);
        }

        .hover-opacity-100:hover {
            opacity: 1 !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        .menu-card-image {
            height: 250px;
        }

        /* Empty State */
        .empty-menu-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 6rem;
            color: #dee2e6;
            margin-bottom: 24px;
        }

        /* ===== WHY CHOOSE SECTION ===== */
        .why-choose-section {
            padding: 80px 0;
            background: white;
        }

        .why-card {
            background: var(--light);
            border-radius: 20px;
            padding: 40px 32px;
            text-align: center;
            transition: var(--transition);
            height: 100%;
        }

        .why-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-md);
        }

        .why-icon-wrapper {
            margin-bottom: 24px;
        }

        .why-icon {
            width: 80px;
            height: 80px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto;
        }

        .why-card h5 {
            font-weight: 700;
            margin-bottom: 12px;
            color: var(--dark);
        }

        .why-card p {
            color: #6c757d;
            line-height: 1.7;
            margin: 0;
        }

        /* ===== FOOTER ===== */
        .footer-user-section {
            background: #1a1d20;
            color: white;
            padding-top: 80px;
            /* width: 100% otomatis karena di luar container */
            margin-top: auto;
            /* Push to bottom in flex container */
        }

        .footer-top {
            padding-bottom: 60px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .footer-brand i {
            color: var(--primary);
            font-size: 2rem;
        }

        .footer-description {
            color: #adb5bd;
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .social-links {
            display: flex;
            gap: 12px;
        }

        .social-link {
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: var(--transition);
            text-decoration: none;
            font-size: 1.25rem;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-4px);
            color: white;
        }

        .footer-heading {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 24px;
            color: white;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #adb5bd;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--primary);
            padding-left: 8px;
        }

        .footer-contact {
            list-style: none;
            padding: 0;
        }

        .footer-contact li {
            display: flex;
            align-items: start;
            gap: 12px;
            margin-bottom: 16px;
            color: #adb5bd;
        }

        .footer-contact i {
            color: var(--primary);
            font-size: 1.25rem;
            margin-top: 2px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 24px 0;
            text-align: center;
        }

        .footer-bottom p {
            color: #6c757d;
            margin: 0;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .hero-user-title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .promo-icon {
                display: none;
            }

            .promo-banner {
                padding: 30px;
            }

            .section-header-user {
                flex-direction: column;
                align-items: flex-start;
            }

            .popular-badge-user {
                align-self: stretch;
                text-align: center;
            }

            /* Perbaikan untuk Feature Bar */
            .feature-bar-item {
                flex-direction: column;
                text-align: center;
            }

            .feature-bar-icon {
                margin: 0 auto;
            }
        }

        @media (max-width: 767px) {
            .hero-user-section {
                padding: 100px 0 60px;
            }

            .hero-user-title {
                font-size: 1.75rem;
            }

            .hero-user-subtitle {
                font-size: 1rem;
            }

            .user-quick-info {
                flex-direction: column;
                gap: 12px;
            }

            .info-item {
                width: 100%;
            }

            .promo-content h3 {
                font-size: 1.25rem;
            }

            .promo-content p {
                font-size: 0.95rem;
            }

            /* Menu Cards */
            .menu-card-image {
                height: 200px;
            }

            .menu-card-title {
                font-size: 1.1rem;
            }

            /* Footer */
            .footer-top {
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }

            .footer-contact li {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .hero-user-title {
                font-size: 1.5rem;
            }

            .hero-user-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn-primary-hero,
            .btn-outline-hero {
                width: 100%;
                text-align: center;
            }

            /* Quick Features - 1 kolom di mobile kecil */
            .quick-features-bar .row>div {
                flex: 0 0 100%;
                max-width: 100%;
            }

            /* Promo Banner */
            .promo-banner {
                padding: 20px;
            }

            .promo-badge {
                font-size: 0.75rem;
                padding: 6px 12px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Simple AOS-like functionality
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('aos-animate');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('[data-aos]').forEach(el => {
                observer.observe(el);
            });

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi stok dari database ke localStorage jika belum ada
            @foreach ($topFoods as $food)
                if (localStorage.getItem('stok_temp_{{ $food->id }}') === null) {
                    localStorage.setItem('stok_temp_{{ $food->id }}', '{{ $food->stok }}');
                }
                updateModalDisplay({{ $food->id }});
            @endforeach

            // Tangani pengiriman form keranjang
            document.querySelectorAll('form[id^="formAddCart"]').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const foodId = this.id.replace('formAddCart', '');
                    const inputQty = document.getElementById('qty' + foodId);
                    const qtyOrdered = parseInt(inputQty.value);

                    let currentStok = parseInt(localStorage.getItem('stok_temp_' + foodId));

                    if (qtyOrdered > currentStok) {
                        e.preventDefault();
                        alert('Maaf, stok tidak mencukupi di keranjang lokal Anda.');
                        return;
                    }

                    // Kurangi stok di localStorage sebelum form dikirim ke server
                    const newStok = currentStok - qtyOrdered;
                    localStorage.setItem('stok_temp_' + foodId, newStok);
                });
            });
        });

        function updateModalDisplay(id) {
            const localStok = localStorage.getItem('stok_temp_' + id);
            const stokDisplay = document.querySelector(`#detailModal${id} .stok-tersedia`);
            const inputQty = document.getElementById('qty' + id);
            const btnSubmit = document.querySelector(`#detailModal${id} button[type="submit"]`);

            if (stokDisplay) {
                stokDisplay.innerText = localStok;
            }

            if (inputQty) {
                inputQty.max = localStok; // Batasi input maksimal sesuai localStorage
                if (parseInt(localStok) <= 0) {
                    inputQty.value = 0;
                    inputQty.min = 0;
                    if (btnSubmit) {
                        btnSubmit.disabled = true;
                        btnSubmit.innerText = 'Stok Habis (di Keranjang)';
                    }
                }
            }
        }

        function incrementQty(id) {
            let input = document.getElementById('qty' + id);
            let currentStok = parseInt(localStorage.getItem('stok_temp_' + id));
            let currentValue = parseInt(input.value);

            if (currentValue < currentStok) {
                input.value = currentValue + 1;
            }
        }

        function decrementQty(id) {
            let input = document.getElementById('qty' + id);
            let currentValue = parseInt(input.value);
            if (currentValue > 1) {
                input.value = currentValue - 1;
            }
        }
    </script>
@endsection
