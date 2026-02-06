@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="mb-5">
            <h2 class="fw-bold mb-0">Keranjang Belanja</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        @php $total = 0; @endphp

                        @forelse($cart as $id => $item)
                            @php
                                $itemHarga = $item['harga'] ?? 0;
                                $total += $itemHarga * $item['quantity'];
                            @endphp
                            <div class="cart-item p-3 mb-3 rounded-3 border" data-id="{{ $id }}">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-5">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $item['image']) }}"
                                                class="rounded-3 shadow-sm me-3" width="80" height="80"
                                                style="object-fit: cover;">
                                            <div>
                                                <h6 class="fw-bold mb-1">
                                                    {{ $item['nama_makanan'] ?? 'Menu Tidak Diketahui' }}</h6>
                                                <p class="text-primary fw-semibold mb-0">
                                                    Rp{{ number_format($itemHarga, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <label class="text-muted small">Qty:</label>
                                            <div class="input-group" style="max-width: 140px;">
                                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                                    onclick="changeQty('{{ $id }}', -1)">-</button>

                                                <input type="number" id="qty-{{ $id }}"
                                                    class="form-control form-control-sm text-center update-cart-qty"
                                                    data-id="{{ $id }}" data-stok="{{ $item['stok'] ?? 0 }}"
                                                    value="{{ $item['quantity'] }}" readonly>

                                                <button class="btn btn-outline-secondary btn-sm" type="button"
                                                    onclick="changeQty('{{ $id }}', 1)">+</button>
                                            </div>
                                        </div>
                                        <small class="text-muted">Stok: {{ $item['stok'] ?? 0 }}</small>
                                    </div>

                                    <div class="col-md-3 text-end">
                                        <p class="fw-bold text-dark mb-2 fs-5">
                                            Rp<span
                                                class="subtotal-val">{{ number_format($itemHarga * $item['quantity'], 0, ',', '.') }}</span>
                                        </p>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"
                                                onclick="return confirm('Hapus?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-cart-x fs-1 text-muted"></i>
                                <h5 class="mt-3 text-muted">Keranjang Kosong</h5>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            @if ($cart)
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4">Ringkasan Pesanan</h5>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fw-bold fs-5">Total</span>
                                <span class="fw-bold text-primary fs-4">Rp<span
                                        id="total-val">{{ number_format($total, 0, ',', '.') }}</span></span>
                            </div>
                            <a href="{{ route('cart.checkout') }}"
                                class="btn btn-success w-100 btn-lg rounded-pill shadow-sm mb-3">
                                <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <style>
        @media (max-width: 991px) {
            .cart-item .row {
                flex-direction: column;
            }

            .cart-item .col-md-5,
            .cart-item .col-md-4,
            .cart-item .col-md-3 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 15px;
            }

            .cart-item .col-md-3 {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
        }

        @media (max-width: 767px) {
            .container {
                padding: 0 15px;
            }

            .py-5 {
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
            }

            .card {
                margin-bottom: 20px;
            }

            .cart-item {
                padding: 15px !important;
            }

            .cart-item img {
                width: 60px;
                height: 60px;
            }

            /* Sticky summary di mobile */
            .sticky-top {
                position: relative !important;
                top: auto !important;
            }
        }

        @media (max-width: 576px) {
            h2 {
                font-size: 1.5rem;
            }

            .cart-item h6 {
                font-size: 0.95rem;
            }

            .input-group {
                max-width: 120px !important;
            }

            .btn-lg {
                padding: 0.75rem 1rem;
                font-size: 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk update LocalStorage agar sinkron dengan halaman Menu
            function syncLocalStorage(id, currentQty, maxStock) {
                // Rumus: Stok Tersedia (Menu) = Total Stok Database - Jumlah di Cart
                let remainingStock = parseInt(maxStock) - parseInt(currentQty);

                // Pastikan tidak minus
                if (remainingStock < 0) remainingStock = 0;

                localStorage.setItem('stok_temp_' + id, remainingStock);

                // Debugging (Opsional, bisa dihapus)
                console.log(
                `Update Stok ID ${id}: Total ${maxStock} - Cart ${currentQty} = Sisa ${remainingStock}`);
            }

            // 1. Event Listener untuk perubahan manual (ketik angka)
            document.querySelectorAll('.update-cart-qty').forEach(input => {
                input.addEventListener('change', function() {
                    let id = this.dataset.id;
                    let quantity = parseInt(this.value);
                    let maxStock = parseInt(this.dataset.stok); // Ambil stok asli dari database
                    let row = this.closest('.cart-item');

                    if (quantity < 1) {
                        this.value = 1;
                        quantity = 1;
                    }

                    // Validasi agar tidak melebihi stok database
                    if (quantity > maxStock) {
                        alert('Jumlah melebihi stok tersedia!');
                        this.value = maxStock;
                        quantity = maxStock;
                    }

                    // UPDATE LOCAL STORAGE DISINI
                    syncLocalStorage(id, quantity, maxStock);

                    // Kirim ke server
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

            // 2. Event Listener Tombol Hapus
            document.querySelectorAll('form[action="{{ route('cart.remove') }}"]').forEach(form => {
                form.addEventListener('submit', function() {
                    const id = this.querySelector('input[name="id"]').value;
                    const row = this.closest('.cart-item');
                    const maxStock = parseInt(row.querySelector('.update-cart-qty').dataset.stok);

                    // Jika dihapus dari cart, berarti stok di menu kembali PENUH (sesuai database)
                    // Karena qty di cart jadi 0
                    localStorage.setItem('stok_temp_' + id, maxStock);
                });
            });
        });

        // 3. Fungsi untuk Tombol Plus/Minus
        function changeQty(id, delta) {
            let input = document.getElementById('qty-' + id);
            let currentVal = parseInt(input.value);
            let maxStok = parseInt(input.dataset.stok);
            let newVal = currentVal + delta;

            // Validasi: Minimal 1 dan Maksimal stok
            if (newVal >= 1 && newVal <= maxStok) {
                input.value = newVal;

                // Update Server & Tampilan Harga
                updateCartRealtime(id, newVal);

                // UPDATE LOCAL STORAGE DISINI (PENTING!)
                // Rumus: Stok Temp = Total Stok DB - Stok Baru di Cart
                let remainingStock = maxStok - newVal;
                localStorage.setItem('stok_temp_' + id, remainingStock);

            } else if (newVal > maxStok) {
                alert('Maaf, jumlah pesanan melebihi stok yang tersedia.');
            }
        }

        function updateCartRealtime(id, quantity) {
            let row = document.querySelector(`.cart-item[data-id="${id}"]`);

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
    </script>
@endsection
