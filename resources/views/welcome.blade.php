@extends('layouts.app')

@section('content')
    <div class="p-5 mb-4 bg-white rounded-3 shadow-sm text-center">
        <h1 class="display-5 fw-bold">Lapar? Pesan Sekarang!</h1>
        <p class="fs-4 text-muted">Makanan lezat, harga hemat, kirim cepat.</p>
    </div>

    <div class="row">
        @foreach ($foods as $food)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top"
                        style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-bold">{{ $food->nama_makanan }}</h5>
                        <p class="text-danger fw-bold fs-5 mb-1">Rp {{ number_format($food->harga) }}</p>
                        <p class="text-muted small">Stok: {{ $food->stok }}</p>
                        <form action="{{ route('cart.add', $food->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button class="btn btn-primary w-100 rounded-pill">
                                <i class="bi bi-plus-lg"></i> Tambah
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
