<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
      $data = [
        'title' => 'About',
        'content' => "Ini adalah halaman About"
      ];
      return view('about', $data);
    }
}
