@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center py-5">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h2 class="fw-bold text-primary">Buat Akun Baru</h2>
                    <p class="text-muted">Bergabunglah bersama kami hari ini</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-floating mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus
                                    placeholder="Nama Lengkap">
                                <label for="name">Nama Lengkap</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="name@example.com">
                                <label for="email">Alamat Email</label>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    autocomplete="new-password" placeholder="Password">
                                <label for="password">Kata Sandi</label>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-4">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Konfirmasi Password">
                                <label for="password-confirm">Konfirmasi Kata Sandi</label>
                            </div>

                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm">
                                    <i class="bi bi-person-plus-fill me-2"></i> Daftar
                                </button>
                            </div>

                            <div class="text-center">
                                <p class="text-muted small mb-0">Sudah punya akun?
                                    <a href="{{ route('login') }}" class="fw-bold text-decoration-none">Masuk di sini</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
