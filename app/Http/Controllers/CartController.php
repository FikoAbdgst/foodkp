<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class CartController extends Controller
{
    public function index()
    {
        // Ambil session, default array kosong
        $cart = session()->get('cart', []);

        // Gunakan variabel baru untuk menampung cart yang sudah dibersihkan
        $updatedCart = [];

        if (is_array($cart)) {
            foreach ($cart as $id => $item) {
                $food = Food::find($id);

                // Cek apakah makanannya masih ada di database?
                if ($food) {
                    // Update stok terbaru dari DB
                    $item['stok'] = $food->stok;

                    // Masukkan ke updatedCart
                    $updatedCart[$id] = $item;
                }
                // Jika $food tidak ditemukan (null), item tersebut TIDAK dimasukkan ke $updatedCart
                // sehingga otomatis terhapus dari cart.
            }

            // Timpa session cart dengan data yang sudah diverifikasi
            session()->put('cart', $updatedCart);
            $cart = $updatedCart;
        }

        return view('cart', compact('cart'));
    }
    public function addToCart(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "nama_makanan" => $food->nama_makanan,
                "quantity" => (int)$quantity,
                "harga" => $food->harga,
                "image" => $food->image,
                "stok" => $food->stok // TAMBAHKAN INI agar saat pertama add tidak error di view
            ];
        }

        session()->put('cart', $cart);
        // Explicitly save session (opsional, tapi membantu di beberapa environment)
        session()->save();

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan!');
    }
    // UPDATE: Dibuat untuk merespon AJAX agar realtime
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = (int)$request->quantity;
            session()->put('cart', $cart);

            // Hitung ulang total untuk dikirim balik ke frontend
            $total = 0;
            foreach ($cart as $item) {
                $total += ($item['harga'] ?? 0) * $item['quantity'];
            }

            return response()->json([
                'status' => 'success',
                'newSubtotal' => number_format($cart[$request->id]["quantity"] * $cart[$request->id]["harga"], 0, ',', '.'),
                'newTotal' => number_format($total, 0, ',', '.')
            ]);
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Item dihapus!');
        }
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        // Ambil data dari Form
        $orderType = $request->input('orderType'); // 'delivery' atau 'takeaway'
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $alamatLengkap = $request->input('alamat_lengkap');

        // Header Pesan
        $pesan = "Halo Admin, saya ingin memesan:\n\n";
        $total = 0;

        // Loop Item Cart
        foreach ($cart as $id => $item) {
            $itemHarga = $item['harga'] ?? 0;
            $subtotal = $itemHarga * $item['quantity'];
            $pesan .= "*" . ($item['nama_makanan'] ?? 'Menu') . "*\n";
            $pesan .= "   Qty: " . $item['quantity'] . " x Rp" . number_format($itemHarga, 0, ',', '.') . "\n";
            $pesan .= "   Subtotal: Rp" . number_format($subtotal, 0, ',', '.') . "\n\n";
            $total += $subtotal;
        }

        $pesan .= "--------------------------\n";
        $pesan .= "*Total Bayar: Rp" . number_format($total, 0, ',', '.') . "*\n\n";

        // Logika Tambahan Pesan Berdasarkan Tipe Order
        $pesan .= "*INFO PENGIRIMAN:*\n";
        if ($orderType === 'delivery') {
            $pesan .= "Metode: *Delivery Order*\n";
            $pesan .= "Alamat: " . $alamatLengkap . "\n";
            // Link Google Maps User
            if ($latitude && $longitude) {
                $pesan .= "Lokasi Saya: https://www.google.com/maps?q={$latitude},{$longitude}";
            } else {
                $pesan .= "Lokasi: (User tidak membagikan lokasi)";
            }
        } else {
            $pesan .= "Metode: 🛍️ *Take Away*\n";
            $pesan .= "Saya akan mengambil pesanan ke lokasi outlet.";
        }

        $url = "https://wa.me/6282263028951?text=" . urlencode($pesan);
        // session()->forget('cart');
        return redirect()->away($url);
    }
}
