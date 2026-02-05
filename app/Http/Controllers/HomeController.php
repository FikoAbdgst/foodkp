<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // app/Http/Controllers/HomeController.php atau controller terkait
    public function index()
    {
        // Mengambil 8 menu yang paling banyak terjual
        $foods = Food::orderBy('terjual', 'desc')->take(8)->get();
        return view('home_user', compact('foods'));
    }
}
