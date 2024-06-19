<?php

namespace App\Http\Controllers\Register;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
  public function index()
  {
    return view('register.index', [
      'title' => "Register"
    ]);
  }

  public function store(Request $request)
  {
    // Format:
    // unique:table,column,except,id
    $validatedData = $request->validate([
      'name' => 'required|min:3|max:100',
      'username' => ['required', 'min:5', 'max:255', 'unique:users,username'],
      'email' => 'required|email:dns|unique:users,email',
      'password' => 'required|min:7|max:12'
    ]);

    // enkripsi password
    // bisa pake bcrypt() atay Hash::make();
    $validatedData['password'] = Hash::make($validatedData['password']);

    // buat session jenis flashdata
    $request->session()->flash('success', 'Registration successfull! Please login');

    // Jangan lupa cek di model pada property guardes dan fillable
    // Jika memakai method create()
    User::create($validatedData);

    return redirect('/login');
  }
}
