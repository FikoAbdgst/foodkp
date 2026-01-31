@extends('layouts.app')

@section('content')
    <h2 class="mb-4 fw-bold"><i class="bi bi-cart-fill text-primary"></i> Keranjang Belanja</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th style="width: 150px">Qty</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @forelse($cart as $id => $item)
                        @php $total += $item['harga'] * $item['quantity'] @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('storage/' . $item['image']) }}" width="50" class="rounded me-3">
                                    <span class="fw-bold">{{ $item['nama'] }}</span>
                                </div>
                            </td>
                            <td>Rp{{ number_format($item['harga']) }}</td>
                            <td>
                                <form action="{{ route('cart.update') }}" method="POST" class="d-flex">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                        class="form-control form-control-sm me-2" min="1">
                                    <button class="btn btn-sm btn-outline-info"><i
                                            class="bi bi-arrow-clockwise"></i></button>
                                </form>
                            </td>
                            <td>Rp{{ number_format($item['harga'] * $item['quantity']) }}</td>
                            <td>
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf @method('DELETE')
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">Keranjang kosong. <a href="/">Mulai
                                    belanja</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($cart)
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <h4 class="fw-bold">Total: <span class="text-danger">Rp{{ number_format($total) }}</span></h4>
                    <a href="{{ route('cart.checkout') }}" class="btn btn-success btn-lg px-5 rounded-pill">
                        <i class="bi bi-whatsapp"></i> Pesan via WhatsApp
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
