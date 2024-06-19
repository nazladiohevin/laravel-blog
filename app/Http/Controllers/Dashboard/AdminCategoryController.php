<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class AdminCategoryController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Menggunakan Gate yang telah dibuat
    $this->authorize('admin');
    return view('dashboard.categories.index', [
      'categories' => Category::all()
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.categories.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $validatedData = $request->validate([
      'name' => 'required|max:100',
      'slug' => 'required|unique:categories,slug'
    ]);

    Category::create($validatedData);
    $request->session()->flash('success', 'Successfully created a new category!');

    redirect('/dashboard/categories');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function show(Category $category)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function edit(Category $category)
  {
    return view('dashboard.categories.edit', [
      'category' => $category
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Category $category)
  {
    $rules = [
      'name' => 'required|max:100',
    ];

    if ($request->slug != $category->slug) {
      $rules['slug'] = 'required|unique:categories,slug';
    }

    $validatedData = $request->validate($rules);

    Category::where('id', $category->id)
      ->update($validatedData);

    return redirect('/dashboard/categories')
      ->with('success', 'Category has been successfully edited');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Category  $category
   * @return \Illuminate\Http\Response
   */
  public function destroy(Category $category)
  {
    Category::destroy($category->id);

    return redirect('/dashboard/categories')
      ->with('success', 'Category Successfully DELETED');
  }

  public function createSlug(Request $request)
  {
    $slug = SlugService::createSlug(Category::class, 'slug', $request->category);
    return response()->json([
      'slug' => $slug
    ]);
  }
}
