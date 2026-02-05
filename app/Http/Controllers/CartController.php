<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }


    public function addToCart(Request $request, $id)
    {
        $food = Food::findOrFail($id);
        $cart = session()->get('cart', []);

        // Ambil quantity dari input, defaultnya 1 jika tidak diisi
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                "name" => $food->nama_makanan,
                "quantity" => $quantity,
                "price" => $food->harga,
                "image" => $food->gambar
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // Update quantity di keranjang
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Keranjang diperbarui!');
        }
    }

    // Hapus item dari keranjang
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

    // Redirect ke WhatsApp
    public function checkout()
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        $pesan = "Halo Admin, saya ingin memesan:\n\n";
        $total = 0;

        foreach ($cart as $id => $item) {
            $subtotal = $item['harga'] * $item['quantity'];
            $pesan .= "🍴 *" . $item['nama'] . "*\n";
            $pesan .= "   Qty: " . $item['quantity'] . " x Rp" . number_format($item['harga']) . "\n";
            $pesan .= "   Subtotal: Rp" . number_format($subtotal) . "\n\n";
            $total += $subtotal;
        }

        $pesan .= "--------------------------\n";
        $pesan .= "💰 *Total Bayar: Rp" . number_format($total) . "*";

        // Ganti nomor di bawah dengan nomor WA Anda (gunakan kode negara 62)
        $url = "https://wa.me/628123456789?text=" . urlencode($pesan);

        session()->forget('cart'); // Kosongkan keranjang setelah checkout
        return redirect()->away($url);
    }
}
