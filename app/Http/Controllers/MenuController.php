<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $foods = Food::where('is_expired', false)->get();

        return view('menu.all', compact('foods'));
    }
}
