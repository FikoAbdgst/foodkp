<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::all();
        return view('admin.foods.index', compact('foods'));
    }

    // app/Http/Controllers/Admin/FoodController.php
    public function dashboard()
    {
        $total_menu = Food::count();
        $total_stok = Food::sum('stok');

        // Ubah take(5) menjadi take(3) agar sesuai rencana rekomendasi
        $topMenus = Food::where('terjual', '>', 0)
            ->orderBy('terjual', 'desc')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('total_menu', 'total_stok', 'topMenus'));
    }
    public function create()
    {
        return view('admin.foods.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = $request->file('image')->store('foods', 'public');

        Food::create([
            'nama_makanan' => $request->nama_makanan,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'image' => $imagePath
        ]);

        return redirect()->route('foods.index')->with('success', 'Makanan berhasil ditambah!');
    }

    public function edit(Food $food)
    {
        return view('admin.foods.edit', compact('food'));
    }

    public function update(Request $request, Food $food)
    {
        $request->validate([
            'nama_makanan' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Logika hapus gambar lama bisa ditambahkan di sini
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        $food->update($data);

        return redirect()->route('foods.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Food $food)
    {
        if ($food->image) {
            Storage::disk('public')->delete($food->image);
        }
        $food->delete();
        return redirect()->route('foods.index')->with('success', 'Makanan dihapus!');
    }
    // app/Http/Controllers/Admin/FoodController.php

    public function stokIndex()
    {
        $foods = Food::all();
        return view('admin.foods.stok', compact('foods'));
    }

    public function stokUpdate(Request $request, Food $food)
    {
        $request->validate([
            'jumlah_terjual' => 'required|integer|min:1|max:' . $food->stok
        ]);

        // Menggunakan nilai yang ada di database saat ini ditambah input baru
        $food->update([
            'stok' => $food->stok - $request->jumlah_terjual,
            'terjual' => $food->terjual + $request->jumlah_terjual
        ]);

        return back()->with('success', "Data penjualan {$food->nama_makanan} berhasil dicatat!");
    }
}
