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

    <script>
        document.querySelectorAll('.update-cart-qty').forEach(input => {
            input.addEventListener('change', function() {
                let id = this.dataset.id;
                let quantity = this.value;
                let row = this.closest('.cart-item');

                if (quantity < 1) return;

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
                            // Update angka subtotal di baris tersebut
                            row.querySelector('.subtotal-val').innerText = data.newSubtotal;
                            // Update angka total keseluruhan
                            document.getElementById('total-val').innerText = data.newTotal;
                        }
                    });
            });
        });
        // Tambahkan event listener pada tombol hapus di cart.blade.php
        document.querySelectorAll('form[action="{{ route('cart.remove') }}"]').forEach(form => {
            form.addEventListener('submit', function() {
                const id = this.querySelector('input[name="id"]').value;
                const qty = parseInt(this.closest('.cart-item').querySelector('.update-cart-qty').value);

                let currentLocalStok = parseInt(localStorage.getItem('stok_temp_' + id)) || 0;
                localStorage.setItem('stok_temp_' + id, currentLocalStok + qty);
            });
        });

        function changeQty(id, delta) {
            let input = document.getElementById('qty-' + id);
            let currentVal = parseInt(input.value);
            let maxStok = parseInt(input.dataset.stok);
            let newVal = currentVal + delta;

            // Validasi: Minimal 1 dan Maksimal stok
            if (newVal >= 1 && newVal <= maxStok) {
                input.value = newVal;
                updateCartRealtime(id, newVal);
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
                        // Update subtotal dan total bayar di halaman
                        row.querySelector('.subtotal-val').innerText = data.newSubtotal;
                        document.getElementById('total-val').innerText = data.newTotal;
                    }
                })
                .catch(err => console.error('Error:', err));
        }
    </script>
@endsection
