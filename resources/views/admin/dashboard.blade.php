@extends('layouts.app')

@section('content')
    <h2 class="fw-bold mb-4">Dashboard Overview</h2>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card bg-primary text-white shadow border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Total Menu</h6>
                            <h2 class="display-4 fw-bold">{{ $total_menu }}</h2>
                        </div>
                        <i class="bi bi-menu-button-wide fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card bg-success text-white shadow border-0">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase mb-1">Total Stok</h6>
                            <h2 class="display-4 fw-bold">{{ $total_stok }}</h2>
                        </div>
                        <i class="bi bi-box-seam fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow border-0 mt-4">
        <div class="card-body p-5 text-center">
            <h4>Siap berjualan hari ini?</h4>
            <p class="text-muted">Kelola menu makanan Anda melalui menu "Kelola Makanan" di samping.</p>
            <a href="{{ route('foods.index') }}" class="btn btn-primary px-4">Mulai Kelola</a>
        </div>
    </div>
@endsection
