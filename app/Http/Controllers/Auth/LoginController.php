<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;


    protected function authenticated($request, $user)
    {
        if ($user->role == 'admin') {
            return redirect()->route('dashboard');
        }

        // UBAH DARI redirect('/') MENJADI redirect('/home')
        return redirect()->route('home.user');
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout'); //
        $this->middleware('auth')->only('logout'); // Menjamin hanya yang login bisa logout
    }
}
