<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index(){      
      $data =  [
        'title' => "Home",
        'content' => "Ini adalah halaman Utama"
      ];
      return view('index', $data);
    }
}
