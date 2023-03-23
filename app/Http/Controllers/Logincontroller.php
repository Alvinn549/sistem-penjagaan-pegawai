<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class Logincontroller extends Controller
{
    public function index()
    {
        return view('login');
    } 

    public function authenticate(Request $request)
    { 

        $credentials = $request->validate([
            'username' => 'required|string|max:30',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

           $request->session()->regenerate();

           Alert::success('LOGIN BERHASIL', 'Sebagai '.auth()->user()->username);

           return redirect()->intended('dashboard');
        }

       Alert::warning('LOGIN GAGAL', 'Silahkan periksa kembali username atau password anda !');
       return back();
   }

   public function logout(Request $request)
   {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerate();

        return redirect('/');
    }
}
