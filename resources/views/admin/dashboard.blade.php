@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="fw-bold mb-4">Dashboard Admin</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-primary text-white p-3">
                    <h5>Total Menu</h5>
                    <h2 class="fw-bold">{{ \App\Models\Food::count() }}</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-success text-white p-3">
                    <h5>Total Pesanan</h5>
                    <h2 class="fw-bold">0</h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm bg-warning text-dark p-3">
                    <h5>User Terdaftar</h5>
                    <h2 class="fw-bold">{{ \App\Models\User::where('role', 'user')->count() }}</h2>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h4>Selamat Datang, {{ Auth::user()->name }}!</h4>
            <p class="text-muted">Gunakan sidebar di samping untuk mengelola data makanan Anda.</p>
        </div>
    </div>
@endsection
