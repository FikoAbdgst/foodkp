<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function index()
    {
        $preOrders = PreOrder::with('user')->latest()->get();
        return view('admin.preorders.index', compact('preOrders'));
    }

    public function show($id)
    {
        $preOrder = PreOrder::with(['user', 'items.food'])->findOrFail($id);
        return view('admin.preorders.show', compact('preOrder'));
    }

    public function updateStatus(Request $request, $id)
    {
        // 1. Aturan Validasi Dasar
        $rules = [
            'status' => 'required|in:pending,accepted,rejected,completed',
        ];

        // 2. Hanya wajibkan alasan tolak JIKA update dilakukan dari tombol tolak awal (bukan manual)
        if (!$request->has('skip_wa') && $request->status == 'rejected') {
            $rules['reject_reason'] = 'required';
            $rules['correct_nominal'] = 'required_if:reject_reason,nominal_kurang';
        }

        $request->validate($rules);

        $preOrder = PreOrder::with('items.food')->findOrFail($id);

        // Update Status di Database
        $preOrder->update(['status' => $request->status]);

        // 3. Jika admin mengupdate manual setelah diskusi (mengandung input skip_wa)
        if ($request->has('skip_wa') || $request->status == 'completed' || $request->status == 'pending') {
            return redirect()->back()
                ->with('success', 'Status pesanan berhasil diperbarui secara manual tanpa mengirim pesan ulang.');
        }

        // ==========================================
        // LOGIKA PESAN WHATSAPP (HANYA SAAT AWAL)
        // ==========================================
        $waNumber = $preOrder->whatsapp;
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }

        $pesan = "";

        if ($request->status == 'accepted') {
            $pesan .= "Halo " . $preOrder->customer_name . ",\n\n";
            $pesan .= "Kami dari Kantin Mardira. Kami ingin mengkonfirmasi pesanan Pre-Order Anda dengan rincian:\n";
            foreach ($preOrder->items as $item) {
                $pesan .= "- " . ($item->food->nama_makanan ?? 'Menu') . " (" . $item->quantity . " porsi)\n";
            }
            $pesan .= "\n*Total: Rp " . number_format($preOrder->total_price, 0, ',', '.') . "*\n\n";
            $pesan .= "Apakah benar ini pesanan Anda? Jika benar, pesanan Anda akan segera kami proses. Terima kasih!";
        } else if ($request->status == 'rejected') {
            $pesan .= "Halo " . $preOrder->customer_name . ",\n\n";
            $pesan .= "Kami dari Kantin Mardira. Apakah Anda benar memesan pesanan Pre-Order sebesar *Rp " . number_format($preOrder->total_price, 0, ',', '.') . "*?\n\n";
            $pesan .= "Jika iya, mohon maaf ";

            if ($request->reject_reason == 'foto_kurang_jelas') {
                $pesan .= "pesanan Anda belum bisa kami proses karena foto bukti pembayaran yang diunggah kurang jelas. Mohon kirimkan ulang bukti pembayaran yang lebih jelas di chat ini.";
            } elseif ($request->reject_reason == 'nominal_kurang') {
                $pesan .= "pesanan Anda belum bisa kami proses karena nominal transfer yang dikirimkan kurang. Seharusnya total tagihannya adalah *Rp " . number_format($request->correct_nominal, 0, ',', '.') . "*. Mohon transfer kekurangannya ke rekening kami agar pesanan bisa diproses.";
            } elseif ($request->reject_reason == 'stok_kurang') {
                $pesan .= "pesanan Anda tidak bisa kami terima karena stok kami saat ini sedang tidak mencukupi untuk pesanan tersebut. Dana yang sudah Anda transfer akan kami kembalikan 100%, mohon informasikan nomor rekening/e-wallet Anda.";
            } elseif ($request->reject_reason == 'tidak_bisa_menerima') {
                $pesan .= "saat ini kami sedang tidak bisa menerima pesanan tersebut. Dana yang sudah Anda transfer akan segera kami kembalikan, mohon informasikan nomor rekening atau e-wallet Anda.";
            }
        }

        $waLink = "https://wa.me/" . $waNumber . "?text=" . urlencode($pesan);

        return redirect()->back()
            ->with('success', 'Status pesanan berhasil diubah. Pesan WhatsApp telah disiapkan.')
            ->with('wa_link', $waLink);
    }
}
