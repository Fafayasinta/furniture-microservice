<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class LoginViewController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {

        return view('admin.auth.login'); // file login.blade.php sudah kamu buat
    }

    // Menampilkan dashboard setelah login sukses
    public function dashboard()
    {
        return view('welcome'); // ganti dengan file dashboard kamu
    }
}
