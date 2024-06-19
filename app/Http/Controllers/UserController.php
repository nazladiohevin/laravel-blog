<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
      return view('author', [
        'title' => 'Author',
        'authors' => User::all()
      ]);
    }

    public function author_post(User $author){
       return view('blog', [
        'title' => 'Author Post',
        'discussion' => "Blog Terkait " . $author->name,
        'posts' => $author->post->load('author', 'category')
       ]);
    }
}
