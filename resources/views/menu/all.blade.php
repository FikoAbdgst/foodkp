@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="page-header-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right">
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home.user') }}">Beranda</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Semua Menu</li>
                        </ol>
                    </nav>
                    <h1 class="page-title">Semua Menu Makanan</h1>
                    <p class="page-subtitle">Jelajahi berbagai pilihan menu lezat kami</p>
                </div>
                <div class="col-lg-4 text-lg-end" data-aos="fade-left">
                    <div class="menu-count-badge">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                        <span>{{ $foods->count() }} Menu Tersedia</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container">
            <div class="filter-bar">
                <div class="filter-item">
                    <label><i class="bi bi-search me-2"></i>Cari Menu</label>
                    <input type="text" id="searchInput" class="form-control search-input"
                        placeholder="Cari nama makanan...">
                </div>
                <div class="filter-item">
                    <label><i class="bi bi-sort-down me-2"></i>Urutkan</label>
                    <select id="sortSelect" class="form-select sort-select">
                        <option value="newest">Terbaru</option>
                        <option value="name-asc">Nama (A-Z)</option>
                        <option value="name-desc">Nama (Z-A)</option>
                        <option value="price-asc">Harga Terendah</option>
                        <option value="price-desc">Harga Tertinggi</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Menu Grid Section -->
    <section class="all-menu-section">
        <div class="container">
            @php
                // Mencari angka terjual tertinggi untuk menentukan label populer
                $maxTerjual = $foods->max('terjual');
            @endphp

            @forelse ($foods as $food)
                @php
                    // Ambil data keranjang dari session
                    $cart = session('cart', []);
                    // Cek berapa banyak item ini yang sudah ada di keranjang
                    $qtyInCart = $cart[$food->id]['quantity'] ?? 0;
                    // Hitung sisa stok efektif (Stok Database - Stok di Keranjang)
                    $effectiveStok = $food->stok - $qtyInCart;

                    // Status Logic
                    $isHabis = $food->stok <= 0;
                    $isFullInCart = !$isHabis && $effectiveStok <= 0;
                    $terjual = $food->terjual ?? 0;
                    $displayTerjual = $terjual >= 10 ? floor($terjual / 10) * 10 . '++' : $terjual;
                    $isPopuler = $terjual > 0 && $terjual == $maxTerjual;
                @endphp

                <div class="col-xl-3 col-lg-4 col-md-6 menu-item" data-name="{{ strtolower($food->nama_makanan) }}"
                    data-price="{{ $food->harga }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="menu-card {{ $isHabis || $isFullInCart ? 'opacity-75' : '' }}">
                        <div class="menu-card-image">
                            <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->nama_makanan }}">
                            <div class="menu-card-badges">
                                @if ($isPopuler)
                                    <span class="badge-popular">
                                        <i class="bi bi-fire text-danger"></i>
                                        Populer
                                    </span>
                                @endif
                            </div>
                            <div class="menu-card-overlay">
                                <button class="btn-quick-view" data-bs-toggle="modal"
                                    data-bs-target="#imageModal{{ $food->id }}" title="Perbesar Gambar">
                                    <i class="bi bi-zoom-in"></i>
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

                            <div class="menu-card-info mb-3">
                                @if ($isHabis)
                                    <span class="badge bg-danger shadow-sm">
                                        <i class="bi bi-x-circle me-1"></i> Stok Habis
                                    </span>
                                @elseif ($isFullInCart)
                                    <span class="badge bg-warning text-dark shadow-sm">
                                        <i class="bi bi-cart-check-fill me-1"></i> Stok di Keranjang
                                    </span>
                                @elseif ($isPopuler)
                                    <span class="badge-popular">
                                        <i class="bi bi-fire text-danger"></i> Populer
                                    </span>
                                @endif
                            </div>

                            <div class="menu-card-price-row">
                                <div class="price-wrapper">
                                    <span class="price-label">Harga</span>
                                    <span class="price-value">Rp {{ number_format($food->harga, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#detailModal{{ $food->id }}">
                                <i class="bi bi-cart-plus me-2"></i> Beli
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="imageModal{{ $food->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-md">
                        <div class="modal-content bg-transparent border-0 shadow-none">
                            <div class="modal-body p-0 text-center position-relative">
                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
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
                <div class="modal fade" id="detailModal{{ $food->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $food->nama_makanan }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-start">
                                <div class="text-center mb-3">
                                    <img src="{{ asset('storage/' . $food->image) }}" class="img-fluid rounded"
                                        style="max-width: 250px; max-height: 250px;">
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-primary mb-0">Rp {{ number_format($food->harga, 0, ',', '.') }}</h4>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-bag-check-fill text-success me-1"></i>
                                        Terjual {{ $displayTerjual }}
                                    </span>
                                </div>
                                <p><strong>Stok Tersedia:</strong> <span class="stok-tersedia">{{ $food->stok }}</span>
                                </p>

                                <form action="{{ route('cart.add', $food->id) }}" method="POST"
                                    id="formAddCart{{ $food->id }}">
                                    @csrf
                                    <div class="mt-4">
                                        <label for="qty{{ $food->id }}" class="form-label font-weight-bold">Jumlah
                                            Pesanan:</label>
                                        <div class="input-group mb-3" style="max-width: 150px;">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="decrementQty({{ $food->id }})">-</button>
                                            <input type="number" name="quantity" id="qty{{ $food->id }}"
                                                class="form-control text-center" value="1" min="1"
                                                max="{{ $food->stok }}">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="incrementQty({{ $food->id }}, {{ $food->stok }})">+</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" form="formAddCart{{ $food->id }}" class="btn btn-primary"
                                    {{ $food->stok < 1 ? 'disabled' : '' }}>
                                    {{ $food->stok < 1 ? 'Stok Habis' : 'Tambah ke Keranjang' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-menu-state">
                        <div class="empty-icon">
                            <i class="bi bi-inbox"></i>
                        </div>
                        <h4>Belum Ada Menu Tersedia</h4>
                        <p>Menu akan segera tersedia. Silakan cek kembali nanti.</p>
                        <a href="{{ route('home.user') }}" class="btn btn-primary-custom mt-3">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Empty Search Result -->
        <div id="noResults" class="empty-search-state" style="display: none;">
            <div class="empty-icon">
                <i class="bi bi-search"></i>
            </div>
            <h4>Tidak Ada Menu yang Cocok</h4>
            <p>Coba kata kunci pencarian lain atau reset filter</p>
        </div>
        </div>
    </section>



    <style>
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

        /* ===== PAGE HEADER ===== */
        .page-header-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            padding: 120px 0 60px;
            margin-top: 76px;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        .modal-image-container {
            background-color: rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            display: inline-block;
            overflow: hidden;
        }

        /* Memastikan bayangan (shadow) terlihat jelas pada gambar modal */
        .modal-image-container img {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .page-title {
            font-size: 2.75rem;
            font-weight: 800;
            color: var(--dark);
            margin-bottom: 12px;
        }

        .page-subtitle {
            font-size: 1.2rem;
            color: #6c757d;
        }

        .menu-count-badge {
            background: white;
            padding: 16px 28px;
            border-radius: 50px;
            box-shadow: var(--shadow-md);
            display: inline-block;
            font-weight: 600;
            color: var(--primary);
        }

        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: white;
            padding: 30px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 76px;
            z-index: 100;
        }

        .filter-bar {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .filter-item {
            flex: 1;
            min-width: 250px;
        }

        .filter-item label {
            display: block;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .search-input,
        .sort-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 0.95rem;
            transition: var(--transition);
        }

        .search-input:focus,
        .sort-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        /* ===== ALL MENU SECTION ===== */
        .all-menu-section {
            padding: 60px 0 80px;
            background: var(--light);
            min-height: 60vh;

        }

        /* Update pada bagian CSS di dalam file all.blade.php */

        .menu-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            /* Menambahkan shadow default */
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .menu-card:hover {
            transform: translateY(-10px);
            /* Membuat shadow lebih tegas saat di-hover */
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
            background: rgba(51, 51, 51, 0.95);
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

        .menu-card-actions {
            display: flex;
            gap: 10px;
            margin-top: auto;
        }

        .btn-detail {
            background: white;
            border: 2px solid var(--primary);
            color: var(--primary);
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-detail:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .btn-add-to-cart {
            background: var(--primary);
            border: 2px solid var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 600;
            width: 100%;
            transition: var(--transition);
            cursor: pointer;
            font-size: 0.9rem;
        }

        .btn-add-to-cart:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
        }

        /* ===== MODAL CUSTOM ===== */
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
            /* Menambahkan shadow pada gambar di dalam modal */
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

        /* ===== EMPTY STATES ===== */
        .empty-menu-state,
        .empty-search-state {
            text-align: center;
            padding: 80px 20px;
        }

        .empty-icon {
            font-size: 6rem;
            color: #dee2e6;
            margin-bottom: 24px;
        }

        .empty-menu-state h4,
        .empty-search-state h4 {
            color: var(--dark);
            margin-bottom: 12px;
        }

        .empty-menu-state p,
        .empty-search-state p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        /* Footer - reuse dari home user */
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
            .page-title {
                font-size: 2rem;
            }

            .filter-bar {
                flex-direction: column;
            }

            .filter-item {
                min-width: 100%;
            }
        }

        @media (max-width: 767px) {
            .page-header-section {
                padding: 100px 0 40px;
            }

            .menu-count-badge {
                display: block;
                text-align: center;
                margin-top: 20px;
            }
        }

        /* AOS Animations */
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

        /* ===== RESPONSIVE ===== */
        @media (max-width: 991px) {
            .page-header-section {
                padding: 100px 0 40px;
            }

            .page-title {
                font-size: 2rem;
            }

            .filter-bar {
                flex-direction: column;
            }

            .filter-item {
                min-width: 100%;
            }

            .menu-count-badge {
                display: block;
                text-align: center;
                margin-top: 15px;
                width: 100%;
            }
        }

        @media (max-width: 767px) {
            .page-header-section {
                padding: 80px 0 30px;
            }

            .page-title {
                font-size: 1.75rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }

            .breadcrumb {
                font-size: 0.85rem;
            }

            /* Filter Section */
            .filter-section {
                padding: 20px 0;
            }

            .filter-item label {
                font-size: 0.9rem;
            }

            /* Menu Cards */
            .menu-card-image {
                height: 200px;
            }

            .menu-card-title {
                font-size: 1.1rem;
            }

            .price-value {
                font-size: 1.5rem;
            }

            .all-menu-section {
                padding: 40px 0 60px;
            }
        }

        @media (max-width: 576px) {
            .page-title {
                font-size: 1.5rem;
            }

            .menu-count-badge {
                font-size: 0.85rem;
                padding: 12px 20px;
            }

            /* 1 kolom di mobile kecil */
            .all-menu-section .row>div {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .search-input,
            .sort-select {
                font-size: 0.9rem;
                padding: 10px 14px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // AOS Animation
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

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            const sortSelect = document.getElementById('sortSelect');
            const menuItems = document.querySelectorAll('.menu-item');
            const menuGrid = document.getElementById('menuGrid');
            const noResults = document.getElementById('noResults');

            function filterAndSort() {
                const searchTerm = searchInput.value.toLowerCase();
                const sortValue = sortSelect.value;

                let visibleCount = 0;
                let items = Array.from(menuItems);

                // Filter
                items.forEach(item => {
                    const name = item.getAttribute('data-name');
                    if (name.includes(searchTerm)) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                // Sort
                if (sortValue === 'name-asc') {
                    items.sort((a, b) => a.getAttribute('data-name').localeCompare(b.getAttribute('data-name')));
                } else if (sortValue === 'name-desc') {
                    items.sort((a, b) => b.getAttribute('data-name').localeCompare(a.getAttribute('data-name')));
                } else if (sortValue === 'price-asc') {
                    items.sort((a, b) => parseInt(a.getAttribute('data-price')) - parseInt(b.getAttribute(
                        'data-price')));
                } else if (sortValue === 'price-desc') {
                    items.sort((a, b) => parseInt(b.getAttribute('data-price')) - parseInt(a.getAttribute(
                        'data-price')));
                }

                // Reorder DOM
                items.forEach(item => menuGrid.appendChild(item));

                // Show/hide no results
                if (visibleCount === 0) {
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                }
            }

            searchInput.addEventListener('input', filterAndSort);
            sortSelect.addEventListener('change', filterAndSort);

            // Initialize tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi stok dari database ke localStorage jika belum ada
            @foreach ($foods as $food)
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
