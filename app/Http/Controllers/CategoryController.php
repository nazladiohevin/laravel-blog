<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{

  public function index(){
    return view('categories', [
      'title' => 'Categories',
      'categories' => Category::all()
    ]);
  }

  public function content(Category $category){
    return view('blog', [
      'title' => $category->name,
      'discussion' => "Blog Terkait " . $category->name,
      'posts' => $category->post
    ]);
  }
}
