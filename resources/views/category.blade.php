@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <div class="container mt-5">
    <ol class="list-group">
      @foreach ($posts as $post)
        <li class="list-group-item border border-0 d-flex justify-content-between align-items-start">
          <div class="ms-2 me-auto">
            <a class="link-me" href="/posts/{{ $post->slug }}"><h3>{{ $post->title }}</h3></a>
            {{ $post->quote }}
          </div>          
        </li>
      @endforeach      
    </ol>
    <span class="badge text-bg-danger me-badge-back"><a href="{{ url('') }}/categories" class="link-me" style="color: white !important"><< Back</a></span>
  </div> 
@endsection
