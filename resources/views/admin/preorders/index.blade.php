@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Manajemen Pre-Order (PO)</h2>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No. Order</th>
                                <th>Nama Pemesan</th>
                                <th>Tanggal Kirim</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($preOrders as $po)
                                <tr>
                                    <td class="fw-bold text-primary">#PO-{{ str_pad($po->id, 4, '0', STR_PAD_LEFT) }}</td>
                                    <td>
                                        {{ $po->customer_name }}<br>
                                        <small class="text-muted"><i class="bi bi-whatsapp"></i> {{ $po->whatsapp }}</small>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($po->delivery_date)->format('d M Y, H:i') }}</td>
                                    <td>Rp {{ number_format($po->total_price, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($po->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu ACC</span>
                                        @elseif($po->status == 'accepted')
                                            <span class="badge bg-primary">Diproses</span>
                                        @elseif($po->status == 'completed')
                                            <span class="badge bg-success">Selesai</span>
                                        @else
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.preorders.show', $po->id) }}"
                                            class="btn btn-sm btn-info text-white">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada data Pre-Order.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
