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

        // Memfilter makanan yang status is_expired-nya bernilai true
        // (Berlaku baik Anda menggunakan Opsi 1 (Dinamis Model) maupun Opsi 2 (AJAX DB))
        $expiredFoods = $foods->filter(function ($food) {
            return $food->is_expired;
        });

        return view('admin.foods.index', compact('foods', 'expiredFoods'));
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
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'masa_tahan_hari' => 'nullable|integer|min:1' // Validasi tambahan
        ]);

        $imagePath = $request->file('image')->store('foods', 'public');

        Food::create([
            'nama_makanan' => $request->nama_makanan,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'image' => $imagePath,
            'masa_tahan_hari' => $request->masa_tahan_hari // Simpan ke database
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
            'masa_tahan_hari' => 'nullable|integer|min:1', // Validasi ini sudah benar
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada gambar baru yang diupload
            if ($food->image) {
                Storage::disk('public')->delete($food->image);
            }
            $data['image'] = $request->file('image')->store('foods', 'public');
        }

        // --- TAMBAHAN KODE BARU DI SINI ---
        // Evaluasi ulang status expired jika masa tahan diubah
        if (empty($request->masa_tahan_hari)) {
            // Jika dikosongkan (makanan tidak bisa basi), kembalikan statusnya ke false
            $data['is_expired'] = false;
        } else {
            // Cek ulang apakah dengan masa tahan yang baru, makanan ini masih expired atau belum
            $batasWaktu = $food->created_at->copy()->addDays((int) $request->masa_tahan_hari);
            $data['is_expired'] = now()->isAfter($batasWaktu);
        }
        // ----------------------------------

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
    public function checkExpired()
    {
        // Cari makanan yang belum expired dan punya masa_tahan_hari
        $foods = Food::where('is_expired', false)
            ->whereNotNull('masa_tahan_hari')
            ->get();

        $jumlahDiupdate = 0;

        foreach ($foods as $food) {
            $batasWaktu = $food->created_at->copy()->addDays($food->masa_tahan_hari);

            if (now()->isAfter($batasWaktu)) {
                $food->update(['is_expired' => true]);
                $jumlahDiupdate++;
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => "Pengecekan selesai. {$jumlahDiupdate} makanan telah diubah menjadi kedaluwarsa."
        ]);
    }
    public function storeRestock(Request $request, Food $food)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'expired_at' => 'required|date',
        ]);

        FoodRestock::create([
            'food_id' => $food->id,
            'quantity' => $request->quantity,
            'expired_at' => $request->expired_at,
        ]);

        return redirect()->back()->with('success', 'Stok berhasil ditambahkan!');
    }
}
