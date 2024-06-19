<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class DashboardPostController extends Controller
{
  /**
   * Display a listing of the resource.
   * not translation: Menampilkan semua data post
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('dashboard.posts.index', [
      'posts' => Post::where('user_id', auth()->user()->id)->get()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   * not translation: Menampilkan halaman tambah postingan
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.posts.create', [
      'categories' => Category::all()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   * not translation: Menjalankan fungsi tambahnya
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {

    /* *
     * file|min atau max: merupakan rentang besarkecilnya file dalam (kb)
     * 
     */
    $validatedData = $request->validate([
      'title' => 'required|max:255',
      'slug' => 'required|unique:posts,slug',
      'category_id' => 'required',
      'content' => 'required',
      'image' => 'image|file|max:1024'
    ]);

    if ($request->file('image')) {
      $validatedData['image'] = $request->file('image')->store('post-image');
    }


    $validatedData['user_id'] = auth()->user()->id;
    $validatedData['quote'] = Str::limit(strip_tags($request->content), 25, '...');

    Post::create($validatedData);

    $request->session()->flash('success', 'Successfully created a new post!');

    return redirect('/dashboard/posts');
  }

  /**
   * Display the specified resource.
   * not translation: lihat detail dari sebuah postingan 
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    return view('dashboard.posts.show', [
      'post' => $post
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   * not translation: untuk menampilkan ubah datanya
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    return view('dashboard.posts.edit', [
      'post' => $post,
      'categories' => Category::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   * not translation: memproses ubah data
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Post $post)
  {
    $rules = [
      'title' => 'required|max:255',
      'category_id' => 'required',
      'content' => 'required',
      'image' => 'image|file|max:1024'
    ];

    if ($request->slug != $post->slug) {
      $rules['slug'] = 'required|unique:posts,slug';
    }

    $validatedData = $request->validate($rules);

    if ($request->file('image')) {
      Storage::delete($post->image);
      $validatedData['image'] = $request->file('image')->store('post-image');
    }

    $validatedData['user_id'] = auth()->user()->id;
    $validatedData['quote'] = Str::limit(strip_tags($request->content), 25, '...');

    if ($post->author->id !== auth()->user()->id) {
      abort(403);
    }

    Post::where('id', $post->id)
      ->update($validatedData);

    return redirect('/dashboard/posts')->with('success', 'Post has been successfully edited');
  }

  /**
   * Remove the specified resource from storage.
   * not translation: Delete postingan
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    Post::destroy($post->id);
    Storage::delete($post->image);

    // Pakai with fungsinya utk mengirim session flashdata
    return redirect('/dashboard/posts')->with('success', 'Post Successfully DELETED');
  }

  public function createSlug(Request $request)
  {
    $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
    return response()->json([
      'slug' => $slug
    ]);
  }
}
