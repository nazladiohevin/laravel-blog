<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  public function index()
  {
    return view('login.index', [
      'title' => 'Login'
    ]);
  }

  public function authenticate(Request $request){
    $credentials = $request->validate([
      'email' => 'required|email',
      'password' => 'required'
    ]);

    // Secara otomatis dicek di model user (defaultya)
    // Bisa diubah di config/auth.php
    if(Auth::attempt($credentials)){
      $request->session()->regenerate();
      return redirect()->intended('/dashboard');
    }

    return back()->with('loginError', 'Login failed!');
  }
}
