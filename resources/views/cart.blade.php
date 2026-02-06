@extends('layouts.app')

@section('content')
    <div class="cart-page">
        <div class="container py-4 py-md-5">
            <!-- Header -->
            <div class="page-header mb-4 mb-md-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h1 class="page-title mb-1">Keranjang Belanja</h1>
                        <p class="text-muted mb-0">Periksa pesanan Anda sebelum checkout</p>
                    </div>

                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-3 g-lg-4">
                <!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="cart-items-container">
                        @php $total = 0; @endphp

                        @forelse($cart as $id => $item)
                            @php
                                $itemHarga = $item['harga'] ?? 0;
                                $total += $itemHarga * $item['quantity'];
                            @endphp
                            <div class="cart-item-card" data-id="{{ $id }}">
                                <div class="cart-item-content">
                                    <!-- Image & Info -->
                                    <div class="item-info">
                                        <div class="item-image">
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                alt="{{ $item['nama_makanan'] ?? 'Menu' }}">
                                            <div class="image-overlay"></div>
                                        </div>
                                        <div class="item-details">
                                            <h5 class="item-name">{{ $item['nama_makanan'] ?? 'Menu Tidak Diketahui' }}</h5>
                                            <p class="item-price">Rp{{ number_format($itemHarga, 0, ',', '.') }}</p>
                                            <span class="stock-badge">
                                                <i class="bi bi-box-seam"></i> Stok: {{ $item['stok'] ?? 0 }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="quantity-controls">
                                        <label class="qty-label">Jumlah</label>
                                        <div class="qty-wrapper">
                                            <button class="qty-btn qty-minus" type="button"
                                                onclick="changeQty('{{ $id }}', -1)">
                                                <i class="bi bi-dash-lg"></i>
                                            </button>
                                            <input type="number" id="qty-{{ $id }}"
                                                class="qty-input update-cart-qty" data-id="{{ $id }}"
                                                data-stok="{{ $item['stok'] ?? 0 }}" value="{{ $item['quantity'] }}"
                                                readonly>
                                            <button class="qty-btn qty-plus" type="button"
                                                onclick="changeQty('{{ $id }}', 1)">
                                                <i class="bi bi-plus-lg"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Subtotal & Delete -->
                                    <div class="item-actions">
                                        <div class="subtotal-wrapper">
                                            <span class="subtotal-label">Subtotal</span>
                                            <p class="subtotal-amount">
                                                Rp<span
                                                    class="subtotal-val">{{ number_format($itemHarga * $item['quantity'], 0, ',', '.') }}</span>
                                            </p>
                                        </div>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="delete-form">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="delete-btn"
                                                onclick="return confirm('Hapus item ini dari keranjang?')">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-cart">
                                <div class="empty-icon">
                                    <i class="bi bi-cart-x"></i>
                                </div>
                                <h4>Keranjang Masih Kosong</h4>
                                <p>Yuk, mulai belanja dan tambahkan menu favorit Anda!</p>
                                <a href="{{ route('menu.all') }}" class="btn-browse-menu">
                                    <i class="bi bi-arrow-left me-2"></i>Lihat Menu
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Order Summary -->
                @if ($cart)
                    <div class="col-lg-4">
                        <div class="order-summary-card">
                            <div class="summary-header">
                                <h5>Ringkasan Pesanan</h5>
                            </div>
                            <div class="summary-body">
                                <div class="summary-row">
                                    <span>Total Item</span>
                                    <span>{{ count($cart) }} item</span>
                                </div>
                                <div class="summary-divider"></div>
                                <div class="summary-total">
                                    <span>Total Pembayaran</span>
                                    <div class="total-amount">
                                        <small>Rp</small>
                                        <span id="total-val">{{ number_format($total, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="summary-footer">
                                <button type="button" class="btn-checkout" data-bs-toggle="modal"
                                    data-bs-target="#checkoutModal">
                                    <i class="bi bi-whatsapp me-2"></i>Lanjutkan Pembayaran
                                </button>
                                <a href="{{ route('menu.all') }}" class="btn-continue-shopping">
                                    <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content custom-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">
                        <i class="bi bi-bag-check me-2"></i>Pilih Metode Pemesanan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
                    @csrf
                    <div class="modal-body">
                        <!-- Order Type Selection -->
                        <div class="order-type-selection mb-4">
                            <div class="row g-3">
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="orderType" id="typeDelivery"
                                        value="delivery" autocomplete="off" checked>
                                    <label class="order-type-card" for="typeDelivery">
                                        <div class="order-type-icon delivery">
                                            <i class="bi bi-bicycle"></i>
                                        </div>
                                        <h6>Delivery</h6>
                                        <p>Antar ke lokasi</p>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="btn-check" name="orderType" id="typeTakeaway"
                                        value="takeaway" autocomplete="off">
                                    <label class="order-type-card" for="typeTakeaway">
                                        <div class="order-type-icon takeaway">
                                            <i class="bi bi-bag-check"></i>
                                        </div>
                                        <h6>Take Away</h6>
                                        <p>Ambil sendiri</p>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Delivery Section -->
                        <div id="deliverySection">
                            <div class="info-box mb-3">
                                <i class="bi bi-info-circle me-2"></i>
                                <span>Klik tombol untuk mendeteksi lokasi Anda secara otomatis</span>
                            </div>

                            <button type="button" class="btn-detect-location mb-3" onclick="getLocation()">
                                <i class="bi bi-geo-alt-fill me-2"></i>Deteksi Lokasi Saya
                            </button>

                            <p id="locationStatus" class="location-status" style="display:none;">
                                <i class="bi bi-check-circle"></i> Lokasi berhasil didapatkan!
                            </p>

                            <div class="form-group">
                                <label for="alamat" class="form-label">
                                    <i class="bi bi-pin-map me-1"></i>Detail Alamat / Patokan
                                </label>
                                <textarea class="form-control custom-textarea" name="alamat_lengkap" id="alamat" rows="3"
                                    placeholder="Contoh: Rumah pagar hitam, sebelah warung Pak Budi..." required></textarea>
                            </div>

                            <input type="hidden" name="latitude" id="lat">
                            <input type="hidden" name="longitude" id="long">
                        </div>

                        <!-- Takeaway Section -->
                        <div id="takeawaySection" style="display: none;">
                            <div class="takeaway-info">
                                <div class="outlet-card">
                                    <div class="outlet-icon">
                                        <i class="bi bi-shop"></i>
                                    </div>
                                    <h6>Lokasi Outlet Kami</h6>
                                    <p class="outlet-address">Jl. Contoh No. 123, Kota Bandung</p>
                                    <a href="https://maps.app.goo.gl/quVkXHeYMxg43TC56" target="_blank" class="btn-map">
                                        <i class="bi bi-map me-2"></i>Lihat di Google Maps
                                    </a>
                                </div>
                                <div class="takeaway-note">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Tunjukkan bukti chat WhatsApp saat pengambilan pesanan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-submit-order">
                            <i class="bi bi-whatsapp me-2"></i>Pesan Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #0d6efd;
            --primary-dark: #0a58ca;
            --secondary-color: #6c757d;
            --success-color: #25D366;
            --danger-color: #dc3545;
            --dark-color: #212529;
            --light-gray: #F8F9FA;
            --border-color: #E0E0E0;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 8px 24px rgba(0, 0, 0, 0.15);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        .cart-page {
            background: linear-gradient(135deg, #f5f7fa 0%, #fff 100%);
            min-height: 100vh;
        }

        /* Page Header */
        .page-header {
            position: relative;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }

        .cart-icon-wrapper {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--shadow-md);
        }

        .cart-icon-wrapper i {
            font-size: 28px;
            color: white;
        }

        /* Custom Alert */
        .custom-alert {
            border: none;
            border-radius: var(--radius-md);
            background: linear-gradient(135deg, #D4EDDA 0%, #C3E6CB 100%);
            border-left: 4px solid var(--success-color);
            box-shadow: var(--shadow-sm);
        }

        /* Cart Items Container */
        .cart-items-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .cart-item-card {
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .cart-item-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .cart-item-content {
            padding: 1.25rem;
            display: grid;
            grid-template-columns: 1fr auto auto;
            gap: 1.5rem;
            align-items: center;
        }

        /* Item Info */
        .item-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .item-image {
            width: 90px;
            height: 90px;
            border-radius: var(--radius-sm);
            overflow: hidden;
            position: relative;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .cart-item-card:hover .item-image img {
            transform: scale(1.1);
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.3));
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .item-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .stock-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            background: var(--light-gray);
            border-radius: 20px;
            font-size: 0.85rem;
            color: #666;
        }

        /* Quantity Controls */
        .quantity-controls {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            align-items: center;
        }

        .qty-label {
            font-size: 0.85rem;
            color: #666;
            font-weight: 500;
        }

        .qty-wrapper {
            display: flex;
            align-items: center;
            background: var(--light-gray);
            border-radius: 50px;
            padding: 0.25rem;
        }

        .qty-btn {
            width: 36px;
            height: 36px;
            border: none;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: var(--dark-color);
        }

        .qty-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }

        .qty-btn:active {
            transform: scale(0.95);
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 1rem;
            color: var(--dark-color);
        }

        /* Item Actions */
        .item-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: 1rem;
        }

        .subtotal-wrapper {
            text-align: right;
        }

        .subtotal-label {
            font-size: 0.85rem;
            color: #666;
            display: block;
            margin-bottom: 0.25rem;
        }

        .subtotal-amount {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin: 0;
        }

        .delete-btn {
            width: 40px;
            height: 40px;
            border: 2px solid var(--danger-color);
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            color: var(--danger-color);
        }

        .delete-btn:hover {
            background: var(--danger-color);
            color: white;
            transform: rotate(15deg) scale(1.1);
        }

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-sm);
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--light-gray), #e9ecef);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .empty-icon i {
            font-size: 60px;
            color: #adb5bd;
        }

        .empty-cart h4 {
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .empty-cart p {
            color: #6c757d;
            margin-bottom: 1.5rem;
        }

        .btn-browse-menu {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 2rem;
            background: var(--primary-color);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-browse-menu:hover {
            background: var(--primary-dark);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Order Summary */
        .order-summary-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-md);
            position: sticky;
            top: 100px;
            overflow: hidden;
        }

        .summary-header {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .summary-header h5 {
            margin: 0;
            font-weight: 700;
        }

        .summary-body {
            padding: 1.5rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
            color: #666;
        }

        .summary-divider {
            height: 1px;
            background: var(--border-color);
            margin: 1rem 0;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background: var(--light-gray);
            border-radius: var(--radius-sm);
        }

        .summary-total>span {
            font-weight: 600;
            color: var(--dark-color);
        }

        .total-amount {
            display: flex;
            align-items: baseline;
            gap: 0.25rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .total-amount small {
            font-size: 0.9rem;
        }

        .total-amount span {
            font-size: 1.75rem;
        }

        .summary-footer {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn-checkout {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, var(--success-color), #20BA56);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        .btn-checkout:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .btn-continue-shopping {
            width: 100%;
            padding: 0.75rem;
            background: transparent;
            color: var(--dark-color);
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-continue-shopping:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
            background: rgba(255, 107, 53, 0.05);
        }

        /* Modal Styles */
        .custom-modal {
            border: none;
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .custom-modal .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            padding: 1.5rem;
            border: none;
        }

        .custom-modal .modal-title {
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .custom-modal .btn-close {
            filter: brightness(0) invert(1);
        }

        .order-type-selection {
            padding: 0;
        }

        .order-type-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 1.5rem 1rem;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: var(--radius-md);
            cursor: pointer;
            transition: all 0.3s ease;
            height: 100%;
        }

        .order-type-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        .btn-check:checked+.order-type-card {
            border-color: var(--primary-color);
            background: linear-gradient(135deg, rgba(255, 107, 53, 0.1), rgba(255, 107, 53, 0.05));
        }

        .order-type-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            transition: all 0.3s ease;
        }

        .order-type-icon.delivery {
            background: linear-gradient(135deg, #E3F2FD, #BBDEFB);
        }

        .order-type-icon.takeaway {
            background: linear-gradient(135deg, #FFF3E0, #FFE0B2);
        }

        .btn-check:checked+.order-type-card .order-type-icon {
            transform: scale(1.1);
        }

        .order-type-icon i {
            font-size: 28px;
            color: var(--primary-color);
        }

        .order-type-card h6 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .order-type-card p {
            font-size: 0.85rem;
            color: #666;
            margin: 0;
        }

        .info-box {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #E3F2FD;
            border-radius: var(--radius-sm);
            color: #1976D2;
            font-size: 0.9rem;
        }

        .btn-detect-location {
            width: 100%;
            padding: 0.875rem;
            background: white;
            border: 2px solid var(--dark-color);
            border-radius: 50px;
            font-weight: 600;
            color: var(--dark-color);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-detect-location:hover {
            background: var(--dark-color);
            color: white;
        }

        .location-status {
            text-align: center;
            padding: 0.75rem;
            background: #D4EDDA;
            border-radius: var(--radius-sm);
            color: #155724;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .custom-textarea {
            border: 2px solid var(--border-color);
            border-radius: var(--radius-sm);
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .custom-textarea:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.15);
            outline: none;
        }

        .outlet-card {
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--light-gray), white);
            border-radius: var(--radius-md);
            text-align: center;
            margin-bottom: 1rem;
        }

        .outlet-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .outlet-icon i {
            font-size: 32px;
            color: white;
        }

        .outlet-card h6 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .outlet-address {
            color: #666;
            margin-bottom: 1rem;
        }

        .btn-map {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: var(--danger-color);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-map:hover {
            background: #E04848;
            color: white;
            transform: translateY(-2px);
        }

        .takeaway-note {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #FFF3E0;
            border-radius: var(--radius-sm);
            color: #E65100;
            font-size: 0.9rem;
        }

        .modal-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            display: flex;
            gap: 1rem;
        }

        .btn-cancel {
            flex: 1;
            padding: 0.875rem;
            background: white;
            border: 2px solid var(--border-color);
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: var(--light-gray);
        }

        .btn-submit-order {
            flex: 2;
            padding: 0.875rem;
            background: linear-gradient(135deg, var(--success-color), #20BA56);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit-order:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Responsive Design */
        @media (max-width: 991px) {
            .cart-item-content {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .item-actions {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }

            .subtotal-wrapper {
                text-align: left;
            }

            .order-summary-card {
                position: relative;
                top: 0;
            }
        }

        @media (max-width: 767px) {
            .page-title {
                font-size: 1.5rem;
            }

            .cart-item-card {
                margin-bottom: 0.75rem;
            }

            .item-image {
                width: 70px;
                height: 70px;
            }

            .item-name {
                font-size: 1rem;
            }

            .item-price {
                font-size: 1.1rem;
            }

            .subtotal-amount {
                font-size: 1.25rem;
            }

            .qty-wrapper {
                padding: 0.15rem;
            }

            .qty-btn {
                width: 32px;
                height: 32px;
            }

            .qty-input {
                width: 45px;
            }
        }

        @media (max-width: 576px) {
            .page-header {
                margin-bottom: 1.5rem !important;
            }

            .cart-item-content {
                padding: 1rem;
            }

            .item-info {
                flex-direction: column;
                align-items: flex-start;
                width: 100%;
            }

            .item-image {
                width: 100%;
                height: 150px;
            }

            .quantity-controls {
                width: 100%;
                flex-direction: row;
                justify-content: space-between;
            }

            .item-actions {
                width: 100%;
            }

            .modal-footer {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-submit-order {
                width: 100%;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sync LocalStorage with Cart
            function syncLocalStorage(id, currentQty, maxStock) {
                let remainingStock = parseInt(maxStock) - parseInt(currentQty);
                if (remainingStock < 0) remainingStock = 0;
                localStorage.setItem('stok_temp_' + id, remainingStock);
                console.log(
                    `Update Stok ID ${id}: Total ${maxStock} - Cart ${currentQty} = Sisa ${remainingStock}`);
            }

            // Manual Quantity Change
            document.querySelectorAll('.update-cart-qty').forEach(input => {
                input.addEventListener('change', function() {
                    let id = this.dataset.id;
                    let quantity = parseInt(this.value);
                    let maxStock = parseInt(this.dataset.stok);
                    let row = this.closest('.cart-item-card');

                    if (quantity < 1) {
                        this.value = 1;
                        quantity = 1;
                    }

                    if (quantity > maxStock) {
                        alert('Jumlah melebihi stok tersedia!');
                        this.value = maxStock;
                        quantity = maxStock;
                    }

                    syncLocalStorage(id, quantity, maxStock);

                    fetch("{{ route('cart.update') }}", {
                            method: "PATCH",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: id,
                                quantity: quantity
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                row.querySelector('.subtotal-val').innerText = data.newSubtotal;
                                document.getElementById('total-val').innerText = data.newTotal;
                            }
                        });
                });
            });

            // Delete Item Handler
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function() {
                    const id = this.querySelector('input[name="id"]').value;
                    const row = this.closest('.cart-item-card');
                    const maxStock = parseInt(row.querySelector('.update-cart-qty').dataset.stok);
                    localStorage.setItem('stok_temp_' + id, maxStock);
                });
            });
        });

        // Quantity Change Function
        function changeQty(id, delta) {
            let input = document.getElementById('qty-' + id);
            let currentVal = parseInt(input.value);
            let maxStok = parseInt(input.dataset.stok);
            let newVal = currentVal + delta;

            if (newVal >= 1 && newVal <= maxStok) {
                input.value = newVal;
                updateCartRealtime(id, newVal);
                let remainingStock = maxStok - newVal;
                localStorage.setItem('stok_temp_' + id, remainingStock);
            } else if (newVal > maxStok) {
                alert('Maaf, jumlah pesanan melebihi stok yang tersedia.');
            }
        }

        // Update Cart in Real-time
        function updateCartRealtime(id, quantity) {
            let row = document.querySelector(`.cart-item-card[data-id="${id}"]`);

            fetch("{{ route('cart.update') }}", {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        id: id,
                        quantity: quantity
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        row.querySelector('.subtotal-val').innerText = data.newSubtotal;
                        document.getElementById('total-val').innerText = data.newTotal;
                    }
                })
                .catch(err => console.error('Error:', err));
        }

        // Order Type Toggle
        const radioDelivery = document.getElementById('typeDelivery');
        const radioTakeaway = document.getElementById('typeTakeaway');
        const deliverySection = document.getElementById('deliverySection');
        const takeawaySection = document.getElementById('takeawaySection');
        const alamatInput = document.getElementById('alamat');

        function toggleOrderType() {
            if (radioDelivery.checked) {
                deliverySection.style.display = 'block';
                takeawaySection.style.display = 'none';
                alamatInput.setAttribute('required', 'required');
            } else {
                deliverySection.style.display = 'none';
                takeawaySection.style.display = 'block';
                alamatInput.removeAttribute('required');
            }
        }

        radioDelivery.addEventListener('change', toggleOrderType);
        radioTakeaway.addEventListener('change', toggleOrderType);

        // Geolocation Functions
        function getLocation() {
            const statusText = document.getElementById('locationStatus');

            if (navigator.geolocation) {
                statusText.style.display = 'block';
                statusText.className = 'location-status';
                statusText.style.background = '#FFF3E0';
                statusText.style.color = '#E65100';
                statusText.innerHTML = '<i class="bi bi-hourglass-split"></i> Sedang mendeteksi lokasi...';

                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }

        function showPosition(position) {
            document.getElementById('lat').value = position.coords.latitude;
            document.getElementById('long').value = position.coords.longitude;

            const statusText = document.getElementById('locationStatus');
            statusText.style.background = '#D4EDDA';
            statusText.style.color = '#155724';
            statusText.innerHTML = '<i class="bi bi-check-circle"></i> Lokasi berhasil terdeteksi!';
        }

        function showError(error) {
            const statusText = document.getElementById('locationStatus');
            statusText.style.display = 'none';

            let message = '';
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    message = "Izin lokasi ditolak. Mohon izinkan akses lokasi di browser Anda.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    message = "Informasi lokasi tidak tersedia.";
                    break;
                case error.TIMEOUT:
                    message = "Waktu permintaan lokasi habis.";
                    break;
                default:
                    message = "Terjadi kesalahan saat mendeteksi lokasi.";
            }
            alert(message);
        }
    </script>
@endsection
