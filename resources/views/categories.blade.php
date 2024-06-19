@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <h1>Blog Categories</h1>
  <div class="container mt-5">
    <div class="row row-cols-1 row-cols-md-3">
      @foreach ($categories as $category)
        <div class="col">
          <div class="card">
            <img src="https://picsum.photos/id/8{{ $category->id }}/600/500" class="card-img-top" alt="">            
            <a href="/posts?category={{ $category->slug }}">
              <div class="card-img-overlay d-flex align-items-center p-0">
                <div class="flex-fill text-center text-white" style="background-color: rgba(0, 0, 0, .5)">
                  <h5 class="card-title py-2">{{ $category->name }}</h5>
                </div>
              </div>
            </a>            
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
