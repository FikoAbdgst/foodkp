<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (is_array($cart)) {
            foreach ($cart as $id => $item) {
                $food = Food::find($id);

                if ($food) {
                    $cart[$id]['stok'] = $food->stok;
                } else {
                    // Opsional: Jika menu sudah dihapus dari DB, bisa dihapus dari cart
                    // unset($cart[$id]);
                }
            }

            session()->put('cart', $cart);
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
                "nama_makanan" => $food->nama_makanan, // Kunci ini harus sama dengan di Blade
                "quantity" => (int)$quantity,
                "harga" => $food->harga,
                "image" => $food->image
            ];
        }

        session()->put('cart', $cart);
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

    public function checkout()
    {
        $cart = session()->get('cart');
        if (!$cart) return redirect()->back();

        $pesan = "Halo Admin, saya ingin memesan:\n\n";
        $total = 0;

        foreach ($cart as $id => $item) {
            $itemHarga = $item['harga'] ?? 0;
            $subtotal = $itemHarga * $item['quantity'];
            $pesan .= "😋 *" . ($item['nama_makanan'] ?? 'Menu') . "*\n";
            $pesan .= "   Qty: " . $item['quantity'] . " x Rp" . number_format($itemHarga) . "\n";
            $pesan .= "   Subtotal: Rp" . number_format($subtotal) . "\n\n";
            $total += $subtotal;
        }

        $pesan .= "--------------------------\n";
        $pesan .= "*Total Bayar: Rp" . number_format($total) . "*";

        $url = "https://wa.me/6282263028951?text=" . urlencode($pesan);
        session()->forget('cart');
        return redirect()->away($url);
    }
}
