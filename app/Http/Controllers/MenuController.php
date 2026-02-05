<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Tampilkan semua menu
     */
    public function index()
    {
        $foods = Food::latest()->get();
        return view('menu.all', compact('foods'));
    }
}
