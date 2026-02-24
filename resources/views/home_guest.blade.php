@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="hero-bg-pattern"></div>
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
        </div>

        <div class="container position-relative" style="padding: 10px 0 100px; z-index: 2;">
            <div class="row align-items-center g-5">
                <div class="col-lg-6 text-center text-lg-start">
                    <div class="hero-content" data-aos="fade-up">
                        <span class="badge hero-badge mb-4">
                            <i class="bi bi-fire me-2"></i>
                            Platform Pesan Makanan Terpercaya
                        </span>
                        <h1 class="hero-title mb-4">
                            Nikmati Makanan<br>
                            <span class="text-gradient">Lezat</span> Kapan Saja
                        </h1>
                        <p class="hero-subtitle mb-5">
                            Pesan makanan favorit Anda dengan mudah. Bahan segar, harga hemat, pengiriman cepat!
                        </p>
                        <div class="hero-buttons d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">
                            <a href="#rekomendasi" class="btn btn-primary-custom btn-lg">
                                <i class="bi bi-shop me-2"></i>
                                Eksplor Menu
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-custom btn-lg">
                                Masuk Sekarang
                            </a>
                        </div>

                        {{-- <!-- Stats -->
                        <div class="hero-stats mt-5 pt-4">
                            <div class="row g-4 text-center text-lg-start">
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number text-primary mb-1">500+</h3>
                                        <p class="stat-label text-muted mb-0">Menu Tersedia</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number text-primary mb-1">10K+</h3>
                                        <p class="stat-label text-muted mb-0">Pelanggan</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-item">
                                        <h3 class="stat-number text-primary mb-1">4.8★</h3>
                                        <p class="stat-label text-muted mb-0">Rating</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <div class="col-lg-6 d-none d-lg-block">
                    <div class="hero-image-section" data-aos="fade-left">
                        <div class="hero-card hero-card-1">
                            <i class="bi bi-emoji-smile-fill"></i>
                            <div>
                                <strong>Makanan Enak Dan Sedap</strong>
                                <p class="mb-0 small text-muted">dengan bahan yang berkualitas</p>
                            </div>
                        </div>
                        <div class="hero-card hero-card-2">
                            <i class="bi bi-clock-fill"></i>
                            <div>
                                <strong>Pengiriman Cepat</strong>
                                <p class="mb-0 small text-muted">30 Menit Tiba</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="mengapa-kami" class="features-section py-5">
        <div class="container">
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Keunggulan Kami</span>
                <h2 class="section-title">Mengapa Memilih Lokomart?</h2>
                <p class="section-description">Kami berkomitmen memberikan pengalaman terbaik untuk Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon bg-primary-light">
                                <i class="bi bi-patch-check-fill text-primary"></i>
                            </div>
                            <div class="feature-shape"></div>
                        </div>
                        <h4 class="feature-title">Bahan Berkualitas</h4>
                        <p class="feature-description">Kami hanya menggunakan bahan segar pilihan terbaik yang disiapkan
                            dengan higienis setiap hari.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon bg-success-light">
                                <i class="bi bi-wallet2 text-success"></i>
                            </div>
                            <div class="feature-shape"></div>
                        </div>
                        <h4 class="feature-title">Harga Terjangkau</h4>
                        <p class="feature-description">Makan enak tidak harus mahal. Nikmati berbagai promo spesial dan
                            harga bersahabat setiap hari.</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-card">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon bg-warning-light">
                                <i class="bi bi-lightning-charge-fill text-warning"></i>
                            </div>
                            <div class="feature-shape"></div>
                        </div>
                        <h4 class="feature-title">Pengiriman Cepat</h4>
                        <p class="feature-description">Sistem logistik modern memastikan pesanan Anda tiba dengan cepat dan
                            tetap hangat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Rekomendasi Section -->
    <section id="rekomendasi" class="menu-section py-5">
        <div class="container">
            <div class="section-header-with-badge mb-5" data-aos="fade-up">
                <div>
                    <span class="section-subtitle">Menu Pilihan</span>
                    <h2 class="section-title mb-0">Menu Rekomendasi</h2>
                </div>
                <span class="popular-badge">
                    <i class="bi bi-star-fill me-2"></i>
                    Paling Populer
                </span>
            </div>

            <div class="row g-4">
                @forelse ($foods as $food)
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="food-card">
                            <div class="food-image-wrapper">
                                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}"
                                    class="w-100 h-100 object-fit-cover">
                                <div class="food-badge">
                                    <i class="bi bi-star-fill"></i>
                                    Populer
                                </div>
                                <div class="food-overlay">
                                    <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}"
                                        class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>

                            <div class="food-card-body">
                                <h5 class="food-name">{{ $food->nama_makanan }}</h5>
                                <div class="food-price-wrapper">
                                    <span class="food-price">Rp {{ number_format($food->harga, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('login') }}" class="btn-order">
                                    <i class="bi bi-cart-plus me-2"></i>
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada menu tersedia saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if (count($foods) > 0)
                <div class="text-center mt-5" data-aos="fade-up">
                    <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg">
                        <i class="bi bi-grid-3x3-gap me-2"></i>
                        Lihat Semua Menu
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-bg-pattern"></div>
        <div class="container position-relative" style="z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" data-aos="zoom-in">
                    <div class="cta-icon mb-4">
                        <i class="bi bi-bell-fill"></i>
                    </div>
                    <h2 class="cta-title mb-3">Siap Untuk Memesan?</h2>
                    <p class="cta-description mb-5">
                        Daftar sekarang dan dapatkan pengalaman pesan makanan yang lebih mudah!<br>
                        <strong>Promo khusus untuk member baru!</strong>
                    </p>
                    <a href="{{ route('register') }}" class="btn btn-light-custom btn-lg">
                        <i class="bi bi-person-plus me-2"></i>
                        Daftar Gratis Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section">
        <div class="container">
            <div class="footer-top">
                <div class="row g-4">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer-brand mb-4">
                            <img src={{ asset('images/logo.png') }} alt="logo" style="width: 50px; height: 50px;">
                            <span>Lokomart</span>
                        </div>
                        <p class="footer-description">
                            Solusi praktis untuk kebutuhan makanan Anda. Pesan dengan mudah, nikmati dengan senang hati.
                        </p>
                        <div class="social-links">
                            <a href="#" class="social-link">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="#" class="social-link">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>



                    <div class="col-lg-6 col-md-6">
                        <h5 class="footer-heading">Hubungi Kami</h5>
                        <ul class="footer-contact">
                            <li>
                                <i class="bi bi-geo-alt-fill"></i>
                                <span>Perum Permata Padalarang D No.23 Desa Jayamekar, Kec Padalarang, Kab Bandung
                                    Barat</span>
                            </li>
                            <li>
                                <i class="bi bi-envelope-fill"></i>
                                <span>lokomart23@gmail.com</span>
                            </li>
                            <li>
                                <i class="bi bi-phone-fill"></i>
                                <span>+62 878-2521-1141</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy;2026 Lokomart Development. All Rights Reserved.</p>
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
            --dark: #212529;
            --light: #f8f9fa;
            --white: #ffffff;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.12);
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ===== GLOBAL STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .hero-bg-pattern {
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

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 100px;
            height: 100px;
            background: var(--primary);
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            background: var(--warning);
            top: 60%;
            right: 15%;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 80px;
            height: 80px;
            background: var(--success);
            bottom: 20%;
            left: 70%;
            animation-delay: 4s;
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

        .hero-badge {
            background: var(--primary-light);
            color: var(--primary);
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-block;
            border: 2px solid rgba(13, 110, 253, 0.2);
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.2;
            color: var(--dark);
            margin-bottom: 1.5rem;
        }

        .text-gradient {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #6c757d;
            line-height: 1.8;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: var(--white);
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.3);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.4);
            color: var(--white);
        }

        .btn-outline-custom {
            background: var(--white);
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 14px 36px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            text-decoration: none;
            display: inline-block;
        }

        .btn-outline-custom:hover {
            background: var(--primary);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: var(--shadow-md);
        }

        .hero-stats {
            border-top: 1px solid #e9ecef;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
        }

        .stat-label {
            font-size: 0.875rem;
        }

        /* Hero Image Section */
        .hero-image-wrapper {
            position: relative;
            height: 500px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-hero-icon {
            font-size: 280px;
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

        .hero-card {
            position: absolute;
            background: var(--white);
            padding: 20px 24px;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 16px;
            animation: floatCard 3s infinite ease-in-out;
            z-index: 2;
        }

        .hero-card i {
            font-size: 2.5rem;
            color: var(--primary);
        }

        .hero-card-1 {
            top: 10%;
            right: 10%;
            animation-delay: 0s;
        }

        .hero-card-2 {
            bottom: 15%;
            left: 5%;
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

        /* ===== FEATURES SECTION ===== */
        .features-section {
            background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
        }

        .section-subtitle {
            color: var(--primary);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.875rem;
            display: block;
            margin-bottom: 12px;
        }

        .section-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .section-description {
            color: #6c757d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--white);
            border-radius: 24px;
            padding: 40px 32px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow-sm);
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            transform: translateY(-12px);
            box-shadow: var(--shadow-lg);
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
            transform: scaleX(0);
            transition: var(--transition);
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 28px;
        }

        .feature-icon {
            width: 90px;
            height: 90px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.75rem;
            position: relative;
            z-index: 2;
            transition: var(--transition);
        }

        .feature-card:hover .feature-icon {
            transform: rotateY(360deg);
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

        .feature-shape {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 110px;
            height: 110px;
            border-radius: 20px;
            background: var(--primary-light);
            opacity: 0.3;
            z-index: 1;
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            from {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            to {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .feature-description {
            color: #6c757d;
            line-height: 1.7;
            margin-bottom: 0;
        }

        /* ===== MENU SECTION ===== */
        .menu-section {
            background: var(--white);
        }

        .section-header-with-badge {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .popular-badge {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 12px 28px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.3);
        }

        .food-card {
            background: var(--white);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .food-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .food-image-wrapper {
            position: relative;
            overflow: hidden;
            height: 240px;
        }

        .food-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }


        .food-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            background: var(--white);
            color: var(--dark);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: var(--shadow-md);
            z-index: 2;
        }

        .food-badge i {
            color: var(--warning);
        }

        .food-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(48, 48, 48, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .food-card:hover .food-overlay {
            opacity: 1;
        }

        .quick-view-btn {
            background: var(--white);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 1.25rem;
            transform: scale(0);
            transition: var(--transition);
            text-decoration: none;
        }

        .food-card:hover .quick-view-btn {
            transform: scale(1);
        }

        .quick-view-btn:hover {
            background: var(--primary);
            color: var(--white);
        }

        .food-card-body {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .food-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .food-price-wrapper {
            margin-bottom: 20px;
        }

        .food-price {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary);
        }

        .btn-order {
            background: var(--light);
            border: 2px solid transparent;
            color: var(--primary);
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            text-align: center;
            transition: var(--transition);
            text-decoration: none;
            display: block;
            margin-top: auto;
        }

        .btn-order:hover {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .empty-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-state i {
            font-size: 5rem;
            color: #dee2e6;
            margin-bottom: 20px;
        }

        .empty-state p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        /* ===== CTA SECTION ===== */
        .cta-section {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }

        .cta-bg-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
            z-index: 1;
        }

        .cta-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--white);
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

        .cta-title {
            font-size: 3rem;
            font-weight: 800;
            color: var(--white);
        }

        .cta-description {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            max-width: 600px;
            margin: 0 auto;
        }

        .btn-light-custom {
            background: var(--white);
            border: none;
            color: var(--primary);
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 700;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
            text-decoration: none;
            display: inline-block;
        }

        .btn-light-custom:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            color: var(--primary);
        }

        /* ===== FOOTER ===== */
        .footer-section {
            background: #1a1d20;
            color: var(--white);
            padding-top: 80px;
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
            color: var(--white);
            transition: var(--transition);
            text-decoration: none;
            font-size: 1.25rem;
        }

        .social-link:hover {
            background: var(--primary);
            transform: translateY(-4px);
            color: var(--white) !important;
        }

        .social-link:hover i {
            color: var(--white) !important;
        }

        .footer-heading {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 24px;
            color: var(--white);
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
            display: inline-block;
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
            font-size: 0.9rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }

            .hero-stats {
                margin-top: 40px !important;
            }
        }

        @media (max-width: 767px) {
            .hero-title {
                font-size: 2rem;
            }

            .section-header-with-badge {
                flex-direction: column;
                align-items: flex-start;
            }

            .popular-badge {
                align-self: stretch;
                text-align: center;
            }
        }

        /* ===== SMOOTH SCROLL ===== */
        html {
            scroll-behavior: smooth;
        }

        /* ===== ANIMATIONS (using data-aos if available) ===== */
        [data-aos] {
            opacity: 0;
            transition-property: opacity, transform;
        }

        [data-aos].aos-animate {
            opacity: 1;
        }

        [data-aos="fade-up"] {
            transform: translateY(30px);
        }

        [data-aos="fade-up"].aos-animate {
            transform: translateY(0);
        }

        [data-aos="fade-left"] {
            transform: translateX(30px);
        }

        [data-aos="fade-left"].aos-animate {
            transform: translateX(0);
        }

        [data-aos="zoom-in"] {
            transform: scale(0.9);
        }

        [data-aos="zoom-in"].aos-animate {
            transform: scale(1);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .hero-section {
                padding: 100px 0 80px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .cta-title {
                font-size: 2rem;
            }

            .hero-stats {
                margin-top: 40px !important;
            }

            /* Features Section */
            .feature-card {
                margin-bottom: 20px;
            }

            /* Menu Section */
            .section-header-with-badge {
                flex-direction: column;
                align-items: flex-start;
            }

            .popular-badge {
                align-self: stretch;
                text-align: center;
            }
        }

        @media (max-width: 767px) {
            .hero-section {
                padding: 80px 0 60px;
                min-height: auto;
            }

            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .hero-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-primary-custom,
            .btn-outline-custom {
                width: 100%;
            }

            /* Stats */
            .hero-stats .col-4 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 15px;
            }

            /* Food Cards */
            .food-card-body {
                padding: 20px;
            }

            .food-name {
                font-size: 1.1rem;
            }

            .food-price {
                font-size: 1.5rem;
            }

            /* CTA Section */
            .cta-section {
                padding: 60px 0;
            }

            .cta-title {
                font-size: 1.75rem;
            }

            .cta-description {
                font-size: 1rem;
            }

            /* Footer */
            .footer-section {
                padding-top: 60px;
            }

            .footer-top {
                text-align: center;
            }

            .social-links {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 1.75rem;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            /* Features */
            .feature-icon {
                width: 70px;
                height: 70px;
                font-size: 2rem;
            }

            .feature-title {
                font-size: 1.25rem;
            }

            /* Food Cards - 1 kolom di mobile kecil */
            .menu-section .row>div {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>

    <!-- AOS Animation Library (Optional - for scroll animations) -->
    <script>
        // Simple AOS-like functionality
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
@endsection
