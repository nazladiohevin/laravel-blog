@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <div class="mt-2" style="margin: 0 12rem">
    <h1 style="margin-bottom: 2px !important">{{ $post->title }}</h1>
    <div class="mb-1">
      <small>
        <i>
          By 
          <a href="/posts?author={{ $post->author->username }}">{{ $post->author->name }}</a>
          In  
          <a href="/posts?category=/{{ $post->category->slug }}">{{ $post->category->name }}</a>
        </i>
      </small>      
    </div>    
    @if ($post->image)
      <div style="max-height:400px;overflow:hidden;" class="mb-4">
        <img src="{{ asset('storage/' . $post->image) }}"  class="card-img-top" alt="...">              
      </div>          
    @else      
      <img src="https://picsum.photos/id/{{ $post->id }}/1200/600" alt="" class="img-thumbnail">
    @endif
    <p>{!! $post->content !!}</p>
  </div>
@endsection