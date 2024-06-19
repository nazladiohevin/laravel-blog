@extends('dashboard.layouts.main')
@section('container')
  <div class="col-lg-8">
    <div class="my-3 ms-4">
      <h1 class="mb-4">{{ $post->title }}</h1>
      <div class="ms-1 my-3">
        <a href="/dashboard/posts" class="btn btn-success">
          <span data-feather="arrow-left"></span>
          Back to all my post
        </a>     
        <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mx-2">Edit</a> 
        <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
          @csrf
          @method('delete')
          <button class="btn btn-danger">Delete</button>
        </form>             
      </div>    
      @if ($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" style="max-height: 400px; overflow:hidden;" class="img-fluid">                
      @else
        <img src="https://picsum.photos/id/{{ $post->id }}/1200/600" alt="" class="img-fluid">        
      @endif
      <p>{!! $post->content !!}</p>
    </div>
  </div>
@endsection