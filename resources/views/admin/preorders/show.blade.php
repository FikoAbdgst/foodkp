@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <a href="{{ route('admin.preorders.index') }}" class="btn btn-sm btn-secondary mb-3"><i class="bi bi-arrow-left"></i>
            Kembali ke Daftar</a>

        <h3 class="fw-bold mb-4">Detail Pesanan #PO-{{ str_pad($preOrder->id, 4, '0', STR_PAD_LEFT) }}</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row g-4">
            <div class="col-lg-7">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold">Daftar Menu</div>
                    <div class="card-body">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($preOrder->items as $item)
                                    <tr>
                                        <td>{{ $item->food->nama_makanan ?? 'Menu Dihapus' }}</td>
                                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="fw-bold">Rp
                                            {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Total Bayar:</th>
                                    <th class="text-primary fs-5">Rp
                                        {{ number_format($preOrder->total_price, 0, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>

                        <h6 class="fw-bold mt-3">Catatan:</h6>
                        <p class="text-muted p-2 bg-light rounded">{{ $preOrder->notes ?: 'Tidak ada catatan.' }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-white fw-bold">Bukti Pembayaran</div>
                    <div class="card-body text-center">
                        <p>Metode: <span class="fw-bold">{{ strtoupper($preOrder->payment_method) }}</span></p>

                        @if ($preOrder->payment_proof)
                            <img src="{{ asset('storage/' . $preOrder->payment_proof) }}"
                                class="img-fluid rounded mb-3 border">
                            <a href="{{ asset('storage/' . $preOrder->payment_proof) }}" target="_blank"
                                class="btn btn-outline-primary btn-sm w-100"><i class="bi bi-arrows-fullscreen"></i> Lihat
                                Gambar Penuh</a>
                        @else
                            <p class="text-danger">Belum ada bukti pembayaran.</p>
                        @endif
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3 text-center">Tindakan Admin</h6>

                        @if ($preOrder->status == 'pending')
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.preorders.update_status', $preOrder->id) }}" method="POST"
                                    class="w-50">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="btn btn-success w-100 fw-bold"><i
                                            class="bi bi-check-circle"></i> Terima</button>
                                </form>

                                <button type="button" class="btn btn-danger w-50 fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#rejectModal">
                                    <i class="bi bi-x-circle"></i> Tolak
                                </button>
                            </div>
                            <small class="d-block text-center text-muted mt-2" style="font-size: 0.8rem;">Tombol akan
                                mengarahkan ke WhatsApp otomatis.</small>
                        @else
                            <div
                                class="alert alert-{{ $preOrder->status == 'accepted' ? 'primary' : ($preOrder->status == 'completed' ? 'success' : 'danger') }} text-center mb-3">
                                Status saat ini: <strong>{{ strtoupper($preOrder->status) }}</strong>
                            </div>

                            <form action="{{ route('admin.preorders.update_status', $preOrder->id) }}" method="POST"
                                class="border-top pt-3">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="skip_wa" value="1">

                                <label class="form-label small fw-bold">Ubah Status (Hasil Diskusi):</label>
                                <div class="input-group">
                                    <select name="status" class="form-select">
                                        <option value="pending" {{ $preOrder->status == 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="accepted" {{ $preOrder->status == 'accepted' ? 'selected' : '' }}>
                                            Terima (Proses)</option>
                                        <option value="completed" {{ $preOrder->status == 'completed' ? 'selected' : '' }}>
                                            Selesai (Diambil)</option>
                                        <option value="rejected" {{ $preOrder->status == 'rejected' ? 'selected' : '' }}>
                                            Tolak</option>
                                    </select>
                                    <button type="submit" class="btn btn-outline-secondary">Update</button>
                                </div>
                                <small class="text-muted d-block mt-2" style="font-size: 0.75rem;">Perubahan status ini
                                    hanya memperbarui data dan tidak akan memicu pesan WhatsApp.</small>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content border-0">
                <form action="{{ route('admin.preorders.update_status', $preOrder->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">

                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="rejectModalLabel">Penolakan Pesanan</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-3 text-muted">Pilih alasan penolakan. Sistem akan menyusun pesan otomatis untuk dikirim
                            ke WhatsApp pemesan.</p>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reject_reason" id="r_foto"
                                value="foto_kurang_jelas" required>
                            <label class="form-check-label fw-bold" for="r_foto">Foto bukti kurang jelas</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reject_reason" id="r_nominal"
                                value="nominal_kurang" required>
                            <label class="form-check-label fw-bold" for="r_nominal">Nominal transfer kurang</label>
                        </div>

                        <div class="mb-3 ms-4 d-none" id="nominal-input-container">
                            <label class="form-label small text-primary fw-bold mb-1">Masukkan nominal yang seharusnya
                                (Rp)</label>
                            <input type="number" class="form-control form-control-sm" name="correct_nominal"
                                id="correct_nominal" placeholder="Contoh: 150000">
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reject_reason" id="r_stok"
                                value="stok_kurang" required>
                            <label class="form-check-label fw-bold" for="r_stok">Stok bahan tidak mencukupi
                                (Refund)</label>
                        </div>

                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="reject_reason" id="r_batal"
                                value="tidak_bisa_menerima" required>
                            <label class="form-check-label fw-bold" for="r_batal">Tidak bisa menerima pesanan
                                (Refund)</label>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger"><i class="bi bi-whatsapp"></i> Tolak & Kirim
                            WA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // --- LOGIC MODAL TOLAK ---
            const radioNominal = document.getElementById('r_nominal');
            const radioOthers = document.querySelectorAll('input[name="reject_reason"]:not(#r_nominal)');
            const nominalContainer = document.getElementById('nominal-input-container');
            const correctNominalInput = document.getElementById('correct_nominal');

            // Munculkan input form angka jika "Nominal transfer kurang" dipilih
            radioNominal.addEventListener('change', function() {
                if (this.checked) {
                    nominalContainer.classList.remove('d-none');
                    correctNominalInput.setAttribute('required', 'required');
                }
            });

            // Sembunyikan input form angka jika radio lain yang dipilih
            radioOthers.forEach(radio => {
                radio.addEventListener('change', function() {
                    if (this.checked) {
                        nominalContainer.classList.add('d-none');
                        correctNominalInput.removeAttribute('required');
                    }
                });
            });

            // --- LOGIC AUTO OPEN WHATSAPP ---
            // Jika terdapat session 'wa_link' yang dikirim dari controller, otomatis buka tab baru
            @if (session('wa_link'))
                window.open("{!! session('wa_link') !!}", "_blank");
            @endif
        });
    </script>
@endsection
