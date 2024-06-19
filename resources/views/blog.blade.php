@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <div class="container mt-3">
    <h1>{{ $discussion }}</h1>
    <div class="row my-3">
      <div class="col-4">
        <form action="/posts" method="get" autocomplete="off">
          <div class="input-group mb-3">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="hidden" name="author" value="{{ request('author') }}">
            <input type="text" name="search" class="form-control" placeholder="Search..."
              value="{{ request('search') }}">
            <button class="input-group-text btn btn-info">Search</button>
          </div>
        </form>
      </div>
    </div>
    @if ($posts->count())
      <div class="card text-center mb-3 mt-3">
        @if ($posts[0]->image)
          <div style="max-height:350px;overflow:hidden;">
            <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="...">
          </div>
        @else
          <img src="https://picsum.photos/id/{{ $posts[0]->id }}/1200/400" class="card-img-top" alt="...">
        @endif
        <div class="card-body">
          <h5 class="card-title"> {{ $posts[0]->title }}</h5>
          <small class="card-subtitle mb-2">
            By <a href="/posts?author={{ $posts[0]->author->username }}">{{ $posts[0]->author->name }}</a>
            in <a href="/posts?category={{ $posts[0]->category->slug }}">{{ $posts[0]->category->name }}</a>,
            <i>{{ $posts[0]->created_at->diffForHumans() }}</i>
          </small>
          <p class="card-text">{{ $posts[0]->quote }}</p>
          <a href="/posts/{{ $posts[0]->slug }}" class="btn btn-primary">Read more</a>
        </div>
      </div>
      <div class="row row-cols-md-4 mt-5 g-4 justify-content-center">
        @foreach ($posts->skip(1) as $post)
          <div class="col">
            <div class="card h-100" style="width: 18rem;">
              @if ($post->image)
                <div style="max-height:350px;overflow:hidden;">
                  <img src="{{ asset('storage/' . $posts[0]->image) }}" class="card-img-top" alt="...">
                </div>
              @else
                <img src="https://picsum.photos/id/{{ $post->id }}/400/300" class="card-img-top">
              @endif
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $post->title }}</h5>
                <small class="card-subtitle mt-1 mb-2">
                  By <a href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                  in <a href="/posts?category={{ $post->category->slug }}">{{ $post->category->name }}</a>
                </small>
                <p class="card-text">{{ $post->quote }}</p>
                <div class="col d-flex align-items-end">
                  <a href="/posts/{{ $post->slug }}" class="btn btn-primary">Read more</a>
                </div>
              </div>
              <div class="card-footer">
                <small class="text-muted">Last updated {{ $post->created_at->diffForHumans() }}</small>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      {!! $posts->links() !!}
    @else
      <h5 class="ms-3" style="color:rgb(163, 163, 163)">Blog not found...</h5>
    @endif
  </div>
@endsection
