@extends('layouts.app')

@section('content')
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3">Lapar? Pesan Sekarang!</h1>
            <p class="lead mb-4">Nikmati makanan lezat dengan harga hemat dan pengiriman secepat kilat.</p>
            <a href="#rekomendasi" class="btn btn-primary btn-lg rounded-pill px-5 shadow">Eksplor Menu</a>
        </div>
    </section>

    <section id="mengapa-kami" class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-5">Mengapa Memilih FoodKP?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="p-4">
                        <i class="bi bi-patch-check feature-icon"></i>
                        <h4 class="fw-bold">Bahan Segar</h4>
                        <p class="text-muted">Kami menjamin setiap bahan yang digunakan adalah kualitas terbaik dan segar
                            setiap hari.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4">
                        <i class="bi bi-wallet2 feature-icon"></i>
                        <h4 class="fw-bold">Harga Hemat</h4>
                        <p class="text-muted">Makan enak tidak harus mahal. Dapatkan berbagai promo menarik setiap
                            minggunya.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="p-4">
                        <i class="bi bi-lightning-charge feature-icon"></i>
                        <h4 class="fw-bold">Kirim Cepat</h4>
                        <p class="text-muted">Sistem logistik kami memastikan makanan sampai di tangan Anda dalam keadaan
                            hangat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="rekomendasi" class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0">Menu Rekomendasi</h2>
                <span class="badge bg-primary rounded-pill">Paling Populer</span>
            </div>

            <div class="row">
                @forelse ($foods as $food)
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                        <div class="card card-menu shadow-sm h-100">
                            <img src="{{ asset('storage/' . $food->image) }}" class="card-img-top"
                                style="height: 200px; object-fit: cover;" alt="{{ $food->nama_makanan }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark">{{ $food->nama_makanan }}</h5>
                                <p class="text-danger fw-bold fs-5 mb-2">Rp {{ number_format($food->harga, 0, ',', '.') }}
                                </p>
                                <div class="mt-auto">
                                    <form action="{{ route('cart.add', $food->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-primary w-100 rounded-pill">
                                            <i class="bi bi-plus-lg"></i> Tambah Ke Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">Belum ada menu tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white pt-5 pb-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <h4 class="fw-bold text-primary">FoodKP</h4>
                    <p class="text-muted">Solusi lapar praktis untuk Anda. Pesan, bayar, dan nikmati makanan Anda tanpa
                        ribet.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold">Tautan Cepat</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-muted">Tentang Kami</a></li>
                        <li><a href="#rekomendasi" class="text-decoration-none text-muted">Menu</a></li>
                        <li><a href="#" class="text-decoration-none text-muted">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="fw-bold">Ikuti Kami</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white fs-4"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-white fs-4"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white fs-4"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <p class="text-center text-muted small">&copy; 2026 FoodKP Development. All Rights Reserved.</p>
        </div>
    </footer>
@endsection
