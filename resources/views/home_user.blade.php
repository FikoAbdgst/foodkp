@extends('layouts.app')

@section('content')
    <!-- Hero Section for Logged In User -->
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

                        <!-- User Quick Info -->
                        <div class="user-quick-info mt-5">
                            <div class="info-item">
                                <i class="bi bi-clock-history"></i>
                                <div>
                                    <strong>Pesanan Terakhir</strong>
                                    <p class="mb-0">2 hari yang lalu</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-star-fill"></i>
                                <div>
                                    <strong>Poin Rewards</strong>
                                    <p class="mb-0">1,250 poin</p>
                                </div>
                            </div>
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

    <!-- Quick Features Bar -->
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

    <!-- Promo Banner -->
    <section class="promo-banner-section" data-aos="zoom-in">
        <div class="container">
            <div class="promo-banner">
                <div class="promo-content">
                    <div class="promo-badge">
                        <i class="bi bi-fire me-2"></i>
                        Promo Spesial
                    </div>
                    <h3>Diskon hingga 30% untuk Member Baru!</h3>
                    <p>Gunakan kode: <strong>NEWMEMBER30</strong></p>
                </div>
                <div class="promo-icon">
                    <i class="bi bi-gift-fill"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Rekomendasi Section -->
    <section id="menu-user" class="menu-user-section">
        <div class="container">
            <div class="section-header-user" data-aos="fade-up">
                <div class="section-header-left">
                    <span class="section-subtitle">Untuk Anda</span>
                    <h2 class="section-title">Menu Rekomendasi</h2>
                </div>
                <div class="section-header-right">
                    <span class="popular-badge-user">
                        <i class="bi bi-star-fill me-2"></i>
                        Paling Populer
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

            <div class="row g-4 mt-2">
                @forelse ($foods as $food)
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="menu-card">
                            <div class="menu-card-image">
                                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}">
                                <div class="menu-card-badges">
                                    <span class="badge-popular">
                                        <i class="bi bi-star-fill"></i>
                                        Populer
                                    </span>
                                </div>
                                <div class="menu-card-overlay">
                                    <button class="btn-quick-view" data-bs-toggle="modal"
                                        data-bs-target="#detailModal{{ $food->id }}" title="Lihat Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                </div>
                                <div class="menu-card-status">
                                    <span class="badge-available">
                                        <i class="bi bi-check-circle-fill"></i>
                                        Tersedia
                                    </span>
                                </div>
                            </div>

                            <div class="menu-card-body">
                                <h5 class="menu-card-title">{{ $food->nama_makanan }}</h5>



                                <div class="menu-card-price-row">
                                    <div class="price-wrapper">
                                        <span class="price-label">Harga</span>
                                        <span class="price-value">Rp {{ number_format($food->harga, 0, ',', '.') }}</span>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $food->id }}">
                                    Detail
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="detailModal{{ $food->id }}" tabindex="-1"
                        aria-labelledby="detailModalLabel{{ $food->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel{{ $food->id }}">
                                        {{ $food->nama_makanan }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="text-center mb-3">
                                        <img src="{{ asset('storage/' . $food->gambar) }}" class="img-fluid rounded"
                                            alt="{{ $food->nama_makanan }}" style="max-height: 300px;">
                                    </div>
                                    <h5>Harga: <span class="text-success">Rp
                                            {{ number_format($food->harga, 0, ',', '.') }}</span></h5>
                                    <p><strong>Stok:</strong> {{ $food->stok }}</p>
                                    <p><strong>Deskripsi:</strong></p>
                                    <p>{{ $food->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <form action="{{ route('cart.add', $food->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary"
                                            {{ $food->stok < 1 ? 'disabled' : '' }}>
                                            {{ $food->stok < 1 ? 'Habis' : 'Tambah ke Keranjang' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="empty-menu-state" data-aos="fade-up">
                            <div class="empty-icon">
                                <i class="bi bi-inbox"></i>
                            </div>
                            <h4>Belum Ada Menu Tersedia</h4>
                            <p>Menu akan segera tersedia. Silakan cek kembali nanti.</p>
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

    <!-- Why Choose Us -->
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

    {{-- <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="section-subtitle">Testimoni</span>
                <h2 class="section-title">Apa Kata Pelanggan Kami</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"Pelayanan cepat, makanan enak, dan harga terjangkau! Sangat
                            recommended untuk yang suka praktis."</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="author-info">
                                <strong>Budi Santoso</strong>
                                <span>Pelanggan Setia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"Aplikasi mudah digunakan, menu beragam. Packaging rapi dan makanan
                            masih hangat saat tiba!"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="author-info">
                                <strong>Siti Rahayu</strong>
                                <span>Food Blogger</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="testimonial-card">
                        <div class="testimonial-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <p class="testimonial-text">"Sudah jadi langganan! Promo sering banget dan customer service
                            responsif. Top deh!"</p>
                        <div class="testimonial-author">
                            <div class="author-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <div class="author-info">
                                <strong>Ahmad Fauzi</strong>
                                <span>Mahasiswa</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Footer -->
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
                <p>&copy; 2026 FoodKP Development. All Rights Reserved.</p>
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

        /* ===== HERO USER SECTION ===== */
        .hero-user-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 100px 0 80px;
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
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-lg);
        }

        .menu-card-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .menu-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .menu-card:hover .menu-card-image img {
            transform: scale(1.15);
        }

        .menu-card-badges {
            position: absolute;
            top: 16px;
            right: 16px;
            z-index: 2;
        }

        .badge-popular {
            background: white;
            color: var(--dark);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            box-shadow: var(--shadow-md);
            display: inline-block;
        }

        .badge-popular i {
            color: var(--warning);
        }

        .menu-card-status {
            position: absolute;
            bottom: 16px;
            left: 16px;
            z-index: 2;
        }

        .badge-available {
            background: var(--success);
            color: white;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
        }

        .menu-card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(13, 110, 253, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition);
        }

        .menu-card:hover .menu-card-overlay {
            opacity: 1;
        }

        .btn-quick-view {
            width: 50px;
            height: 50px;
            background: white;
            border: none;
            border-radius: 50%;
            color: var(--primary);
            font-size: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transform: scale(0);
            transition: var(--transition);
            cursor: pointer;
        }

        .menu-card:hover .btn-quick-view {
            transform: scale(1);
        }

        .btn-quick-view:hover {
            background: var(--primary);
            color: white;
            transform: scale(1.1);
        }

        .menu-card-body {
            padding: 24px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .menu-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 12px;
            line-height: 1.4;
        }

        .menu-card-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .rating-stars-user {
            display: flex;
            gap: 2px;
        }

        .rating-stars-user i {
            color: var(--warning);
            font-size: 0.85rem;
        }

        .rating-text {
            font-weight: 600;
            color: var(--dark);
            font-size: 0.9rem;
        }

        .menu-card-price-row {
            margin-bottom: 20px;
        }

        .price-wrapper {
            display: flex;
            flex-direction: column;
        }

        .price-label {
            font-size: 0.85rem;
            color: #6c757d;
            margin-bottom: 4px;
        }

        .price-value {
            font-size: 1.75rem;
            font-weight: 800;
            color: var(--primary);
        }

        .btn-add-to-cart {
            background: var(--light);
            border: 2px solid transparent;
            color: var(--primary);
            padding: 12px 24px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            transition: var(--transition);
            cursor: pointer;
        }

        .btn-add-to-cart:hover {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
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

        .empty-menu-state h4 {
            color: var(--dark);
            margin-bottom: 12px;
        }

        .empty-menu-state p {
            color: #6c757d;
            font-size: 1.1rem;
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

        /* ===== TESTIMONIALS SECTION ===== */
        .testimonials-section {
            padding: 80px 0;
            background: var(--light);
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 32px;
            box-shadow: var(--shadow-sm);
            transition: var(--transition);
            height: 100%;
        }

        .testimonial-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .testimonial-rating {
            display: flex;
            gap: 4px;
            margin-bottom: 20px;
        }

        .testimonial-rating i {
            color: var(--warning);
            font-size: 1rem;
        }

        .testimonial-text {
            color: #495057;
            font-style: italic;
            line-height: 1.8;
            margin-bottom: 24px;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 12px;
            padding-top: 20px;
            border-top: 2px solid var(--light);
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            font-size: 2rem;
        }

        .author-info strong {
            display: block;
            color: var(--dark);
            font-size: 1rem;
        }

        .author-info span {
            color: #6c757d;
            font-size: 0.85rem;
        }

        /* ===== FOOTER ===== */
        .footer-user-section {
            background: #1a1d20;
            color: white;
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
        }

        @media (max-width: 767px) {
            .hero-user-title {
                font-size: 1.75rem;
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
        }

        /* ===== AOS ANIMATIONS ===== */
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

        [data-aos="fade-right"] {
            transform: translateX(-30px);
        }

        [data-aos="fade-right"].aos-animate {
            transform: translateX(0);
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

        /* ===== MODAL STYLES ===== */
        .modal-custom {
            border: none;
            border-radius: 24px;
            overflow: hidden;
        }

        .modal-custom .modal-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 24px 32px;
        }

        .modal-custom .modal-body {
            padding: 32px;
        }

        .modal-image-wrapper {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .modal-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
        }

        .modal-badge-wrapper {
            position: absolute;
            top: 16px;
            left: 16px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .modal-product-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 16px;
        }

        .modal-rating {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .rating-stars-modal {
            display: flex;
            gap: 4px;
        }

        .rating-stars-modal i {
            color: var(--warning);
            font-size: 1.1rem;
        }

        .rating-count {
            color: #6c757d;
            font-weight: 500;
        }

        .modal-price {
            background: var(--light);
            padding: 20px;
            border-radius: 12px;
        }

        .price-tag {
            display: block;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .price-amount {
            color: var(--primary);
            font-weight: 800;
            margin: 0;
        }

        .modal-description h6,
        .modal-features h6 {
            font-size: 1rem;
        }

        .modal-description p {
            line-height: 1.8;
        }

        .features-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .features-list li {
            padding: 8px 0;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .features-list i {
            font-size: 1rem;
        }

        .btn-add-modal {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            border: none;
            color: white;
            padding: 14px 32px;
            border-radius: 50px;
            font-weight: 700;
            width: 100%;
            transition: var(--transition);
            box-shadow: 0 4px 16px rgba(13, 110, 253, 0.3);
            font-size: 1.05rem;
        }

        .btn-add-modal:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(13, 110, 253, 0.4);
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
    </script>
@endsection
