@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section position-relative overflow-hidden">
        <div class="hero-bg"></div>
        <div class="container position-relative" style="padding: 120px 0 100px;">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <span class="badge bg-primary bg-opacity-10 text-primary px-4 py-2 rounded-pill mb-3">
                        <i class="bi bi-fire"></i> Platform Pesan Makanan Terpercaya
                    </span>
                    <h1 class="display-3 fw-bold mb-4" style="line-height: 1.2;">
                        Nikmati Makanan <span class="text-primary">Lezat</span> Kapan Saja
                    </h1>
                    <p class="lead text-muted mb-4" style="font-size: 1.2rem;">
                        Pesan makanan favorit Anda dengan mudah. Bahan segar, harga hemat, pengiriman cepat!
                    </p>
                    <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                        <a href="#rekomendasi" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                            <i class="bi bi-shop"></i> Eksplor Menu
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg rounded-pill px-5">
                            Masuk Sekarang
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block text-center">
                    <div class="hero-image-wrapper">
                        <i class="bi bi-basket2-fill" style="font-size: 300px; color: rgba(13, 110, 253, 0.1);"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mengapa Kami Section -->
    <section id="mengapa-kami" class="py-5" style="background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary fw-semibold text-uppercase" style="letter-spacing: 2px;">Keunggulan Kami</span>
                <h2 class="display-5 fw-bold mt-2 mb-3">Mengapa Memilih FoodKP?</h2>
                <p class="text-muted">Kami berkomitmen memberikan pengalaman terbaik untuk Anda</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift" style="transition: all 0.3s;">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon-wrapper mb-4">
                                <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-patch-check-fill text-primary" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3">Bahan Berkualitas</h4>
                            <p class="text-muted mb-0">Kami hanya menggunakan bahan segar pilihan terbaik yang disiapkan
                                dengan higienis setiap hari.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift" style="transition: all 0.3s;">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon-wrapper mb-4">
                                <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-wallet2 text-success" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3">Harga Terjangkau</h4>
                            <p class="text-muted mb-0">Makan enak tidak harus mahal. Nikmati berbagai promo spesial dan
                                harga bersahabat setiap hari.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100 hover-lift" style="transition: all 0.3s;">
                        <div class="card-body text-center p-5">
                            <div class="feature-icon-wrapper mb-4">
                                <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center"
                                    style="width: 80px; height: 80px;">
                                    <i class="bi bi-lightning-charge-fill text-warning" style="font-size: 2.5rem;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold mb-3">Pengiriman Cepat</h4>
                            <p class="text-muted mb-0">Sistem logistik modern memastikan pesanan Anda tiba dengan cepat dan
                                tetap hangat.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Rekomendasi Section -->
    <section id="rekomendasi" class="py-5 bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <span class="text-primary fw-semibold text-uppercase" style="letter-spacing: 2px;">Menu Pilihan</span>
                    <h2 class="display-6 fw-bold mt-1 mb-0">Menu Rekomendasi</h2>
                </div>
                <span class="badge bg-primary rounded-pill px-4 py-2" style="font-size: 0.9rem;">
                    <i class="bi bi-star-fill"></i> Paling Populer
                </span>
            </div>

            <div class="row g-4">
                @forelse ($foods as $food)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 card-hover"
                            style="transition: all 0.3s; overflow: hidden;">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top food-image"
                                    style="height: 220px; object-fit: cover; transition: transform 0.3s;"
                                    alt="{{ $food->nama_makanan }}">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-white text-dark shadow-sm">
                                        <i class="bi bi-star-fill text-warning"></i> Populer
                                    </span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title fw-bold mb-2" style="font-size: 1.1rem;">{{ $food->nama_makanan }}
                                </h5>
                                <div class="d-flex align-items-center mb-3">
                                    <span class="text-primary fw-bold fs-4">Rp
                                        {{ number_format($food->harga, 0, ',', '.') }}</span>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('login') }}"
                                        class="btn btn-outline-primary w-100 rounded-pill btn-hover">
                                        <i class="bi bi-box-arrow-in-right"></i> Login untuk Pesan
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-inbox" style="font-size: 4rem; color: #dee2e6;"></i>
                            <p class="text-muted mt-3 mb-0">Belum ada menu tersedia saat ini.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            @if (count($foods) > 0)
                <div class="text-center mt-5">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg rounded-pill px-5">
                        <i class="bi bi-box-arrow-in-right"></i> Login untuk Lihat Semua Menu
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container text-center">
            <h2 class="display-5 fw-bold mb-3">Siap Untuk Memesan?</h2>
            <p class="lead mb-4">Daftar sekarang dan dapatkan pengalaman pesan makanan yang lebih mudah!</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-5">
                <i class="bi bi-person-plus"></i> Daftar Gratis
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h4 class="fw-bold text-primary mb-4">
                        <i class="bi bi-basket2-fill"></i> FoodKP
                    </h4>
                    <p class="text-muted mb-4">
                        Solusi praktis untuk kebutuhan makanan Anda. Pesan dengan mudah, nikmati dengan senang hati.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"
                            style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"
                            style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light btn-sm rounded-circle"
                            style="width: 40px; height: 40px; padding: 0; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-twitter"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-4">Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Tentang
                                Kami</a></li>
                        <li class="mb-2"><a href="#mengapa-kami"
                                class="text-decoration-none text-muted hover-link">Mengapa Kami</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Karir</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-4">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#rekomendasi" class="text-decoration-none text-muted hover-link">Menu
                                Populer</a></li>
                        <li class="mb-2"><a href="{{ route('login') }}"
                                class="text-decoration-none text-muted hover-link">Semua Menu</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Promo</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-4">Hubungi Kami</h5>
                    <ul class="list-unstyled text-muted">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill text-primary"></i> Jl. Contoh No. 123, Bandung
                        </li>
                        <li class="mb-2"><i class="bi bi-envelope-fill text-primary"></i> info@foodkp.com</li>
                        <li class="mb-2"><i class="bi bi-phone-fill text-primary"></i> +62 812-3456-789</li>
                    </ul>
                </div>
            </div>

            <hr class="my-4 border-secondary opacity-25">

            <div class="text-center">
                <p class="text-muted small mb-0">
                    &copy; 2026 FoodKP Development. All Rights Reserved.
                </p>
            </div>
        </div>
    </footer>

    <style>
        .hero-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(255, 255, 255, 1) 100%);
            z-index: 0;
        }

        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .card-hover:hover .food-image {
            transform: scale(1.1);
        }

        .btn-hover:hover {
            background-color: #0d6efd;
            color: white;
            transform: translateY(-2px);
        }

        .hover-link {
            transition: all 0.3s;
        }

        .hover-link:hover {
            color: #0d6efd !important;
            padding-left: 5px;
        }
    </style>
@endsection
