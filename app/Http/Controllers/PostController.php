<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
  public function index()
  {
    return view(
      'blog',
      [
        'title' => "Blog",
        'discussion' => "Blog Terkini",
        'posts' => Post::latest()
          ->filter(request(['search', 'category', 'author']))
          ->paginate(7)
      ]
    );
  }

  // Menggunakan route model binding
  public function content(Post $post)
  {
    return view('blogpost', [
      'title' => $post->title,
      'post' => $post
    ]);
  }
}
