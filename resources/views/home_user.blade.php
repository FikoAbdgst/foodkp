@extends('layouts.app')

@section('content')
    <!-- Hero Section for Logged In User -->
    <section class="hero-section-user position-relative overflow-hidden"
        style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.05) 0%, rgba(255, 255, 255, 1) 100%); padding: 80px 0 60px;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-3">
                        Selamat Datang Kembali, <span class="text-primary">{{ Auth::user()->name }}</span>! 👋
                    </h1>
                    <p class="lead text-muted mb-4">
                        Siap untuk menikmati makanan lezat hari ini? Pilih menu favorit Anda dan pesan sekarang!
                    </p>
                    <a href="#menu-user" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm">
                        <i class="bi bi-arrow-down-circle"></i> Lihat Menu
                    </a>
                </div>
                <div class="col-lg-4 d-none d-lg-block text-center">
                    <i class="bi bi-emoji-smile-fill" style="font-size: 180px; color: rgba(13, 110, 253, 0.15);"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Stats Section -->
    <section class="py-4 bg-white border-bottom">
        <div class="container">
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="bi bi-lightning-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Proses Cepat</h6>
                            <small class="text-muted">Pesan dalam hitungan menit</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                            <i class="bi bi-shield-check text-success fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Aman & Terpercaya</h6>
                            <small class="text-muted">Transaksi terjamin</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex align-items-center p-3 bg-light rounded-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                            <i class="bi bi-star-fill text-warning fs-4"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">Kualitas Terbaik</h6>
                            <small class="text-muted">Bahan fresh setiap hari</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Rekomendasi Section -->
    <section id="menu-user" class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
                <div>
                    <span class="text-primary fw-semibold text-uppercase" style="letter-spacing: 2px;">Untuk Anda</span>
                    <h2 class="display-6 fw-bold mt-1 mb-0">Menu Rekomendasi</h2>
                </div>
                <span class="badge bg-primary rounded-pill px-4 py-2" style="font-size: 0.9rem;">
                    <i class="bi bi-star-fill"></i> Paling Populer
                </span>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-pill" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4">
                @forelse ($foods as $food)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 card-hover-user"
                            style="transition: all 0.3s; overflow: hidden;">
                            <div class="position-relative overflow-hidden">
                                <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top food-image-user"
                                    style="height: 220px; object-fit: cover; transition: transform 0.3s;"
                                    alt="{{ $food->nama_makanan }}">
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-white text-dark shadow-sm">
                                        <i class="bi bi-star-fill text-warning"></i> Populer
                                    </span>
                                </div>
                                <div class="position-absolute bottom-0 start-0 m-3">
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle"></i> Tersedia
                                    </span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column p-4">
                                <h5 class="card-title fw-bold mb-2" style="font-size: 1.1rem;">{{ $food->nama_makanan }}
                                </h5>
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <span class="text-primary fw-bold fs-4">Rp
                                        {{ number_format($food->harga, 0, ',', '.') }}</span>
                                    <div class="text-warning small">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <form action="{{ route('cart.add', $food->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100 rounded-pill btn-add-cart">
                                            <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                                        </button>
                                    </form>
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
        </div>
    </section>

    <!-- Mengapa Kami Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <span class="text-primary fw-semibold text-uppercase" style="letter-spacing: 2px;">Keunggulan Kami</span>
                <h2 class="display-6 fw-bold mt-2 mb-3">Mengapa Pilih FoodKP?</h2>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-primary bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-patch-check-fill text-primary" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Bahan Berkualitas</h5>
                            <p class="text-muted small mb-0">Menggunakan bahan segar pilihan terbaik</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-success bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-wallet2 text-success" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Harga Terjangkau</h5>
                            <p class="text-muted small mb-0">Promo spesial dan harga bersahabat</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 bg-light h-100">
                        <div class="card-body text-center p-4">
                            <div class="rounded-circle bg-warning bg-opacity-10 d-inline-flex align-items-center justify-content-center mb-3"
                                style="width: 70px; height: 70px;">
                                <i class="bi bi-lightning-charge-fill text-warning" style="font-size: 2rem;"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Pengiriman Cepat</h5>
                            <p class="text-muted small mb-0">Pesanan tiba cepat dan tetap hangat</p>
                        </div>
                    </div>
                </div>
            </div>
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
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Karir</a>
                        </li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Blog</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-4">Menu</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#menu-user" class="text-decoration-none text-muted hover-link">Menu
                                Populer</a></li>
                        <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-link">Semua
                                Menu</a></li>
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
        .card-hover-user:hover {
            transform: translateY(-8px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, .175) !important;
        }

        .card-hover-user:hover .food-image-user {
            transform: scale(1.1);
        }

        .btn-add-cart {
            transition: all 0.3s;
            font-weight: 600;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
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
