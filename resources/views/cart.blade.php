@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <!-- Header Section -->
        <div class="mb-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home.user') }}" class="text-decoration-none">Beranda</a>
                    </li>
                    <li class="breadcrumb-item active">Keranjang Belanja</li>
                </ol>
            </nav>
            <div class="d-flex align-items-center mb-2">
                <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                    <i class="bi bi-cart-fill text-primary" style="font-size: 2rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bold mb-0">Keranjang Belanja</h2>
                    <p class="text-muted mb-0">Kelola pesanan Anda sebelum checkout</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        @php
                            $total = 0;
                            $itemCount = count($cart);
                        @endphp

                        @if ($itemCount > 0)
                            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                                <h5 class="fw-bold mb-0">Item di Keranjang</h5>
                                <span class="badge bg-primary rounded-pill px-3 py-2">{{ $itemCount }} Item</span>
                            </div>
                        @endif

                        @forelse($cart as $id => $item)
                            @php $total += $item['harga'] * $item['quantity'] @endphp
                            <div class="cart-item p-3 mb-3 rounded-3 border" style="transition: all 0.3s;">
                                <div class="row align-items-center g-3">
                                    <!-- Product Image & Name -->
                                    <div class="col-md-5">
                                        <div class="d-flex align-items-center">
                                            <div class="position-relative me-3">
                                                <img src="{{ asset('storage/' . $item['image']) }}"
                                                    class="rounded-3 shadow-sm" width="80" height="80"
                                                    style="object-fit: cover;">
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $item['nama'] }}</h6>
                                                <p class="text-primary fw-semibold mb-0">
                                                    Rp{{ number_format($item['harga'], 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls -->
                                    <div class="col-md-4">
                                        <form action="{{ route('cart.update') }}" method="POST"
                                            class="d-flex align-items-center gap-2">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <label class="text-muted small me-2">Qty:</label>
                                            <div class="input-group" style="max-width: 150px;">
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                    class="form-control text-center" min="1"
                                                    style="border-radius: 8px 0 0 8px;">
                                                <button class="btn btn-outline-primary" style="border-radius: 0 8px 8px 0;">
                                                    <i class="bi bi-arrow-clockwise"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Subtotal & Remove -->
                                    <div class="col-md-3 text-end">
                                        <p class="fw-bold text-dark mb-2" style="font-size: 1.1rem;">
                                            Rp{{ number_format($item['harga'] * $item['quantity'], 0, ',', '.') }}
                                        </p>
                                        <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button class="btn btn-sm btn-outline-danger rounded-pill"
                                                onclick="return confirm('Hapus item ini dari keranjang?')">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-cart-x" style="font-size: 5rem; color: #dee2e6;"></i>
                                <h5 class="mt-4 mb-3 text-muted">Keranjang Anda Masih Kosong</h5>
                                <p class="text-muted mb-4">Mulai berbelanja dan tambahkan makanan favorit Anda!</p>
                                <a href="{{ route('home.user') }}" class="btn btn-primary rounded-pill px-5">
                                    <i class="bi bi-arrow-left"></i> Mulai Belanja
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            @if ($cart)
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Subtotal ({{ $itemCount }} item)</span>
                                    <span class="fw-semibold">Rp{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Biaya Pengiriman</span>
                                    <span class="text-success fw-semibold">Gratis</span>
                                </div>
                            </div>

                            <hr class="my-3">

                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold text-primary fs-4">Rp{{ number_format($total, 0, ',', '.') }}</span>
                            </div>

                            <div class="alert alert-info bg-primary bg-opacity-10 border-0 mb-4">
                                <div class="d-flex">
                                    <i class="bi bi-info-circle text-primary me-2"></i>
                                    <small class="text-muted">
                                        Pesanan akan dikirim melalui WhatsApp untuk konfirmasi lebih lanjut.
                                    </small>
                                </div>
                            </div>

                            <a href="{{ route('cart.checkout') }}"
                                class="btn btn-success w-100 btn-lg rounded-pill shadow-sm mb-3">
                                <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                            </a>

                            <a href="{{ route('home.user') }}" class="btn btn-outline-primary w-100 rounded-pill">
                                <i class="bi bi-arrow-left"></i> Lanjut Belanja
                            </a>
                        </div>
                    </div>

                    <!-- Promo Section -->
                    <div class="card border-0 bg-light mt-4 rounded-4">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-gift text-primary" style="font-size: 2.5rem;"></i>
                            <h6 class="fw-bold mt-3 mb-2">Promo Spesial!</h6>
                            <p class="text-muted small mb-0">Dapatkan diskon hingga 30% untuk pesanan pertama Anda</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .cart-item:hover {
            background-color: rgba(13, 110, 253, 0.03);
            border-color: rgba(13, 110, 253, 0.3) !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .btn {
            transition: all 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            font-size: 1.2rem;
        }
    </style>
@endsection
