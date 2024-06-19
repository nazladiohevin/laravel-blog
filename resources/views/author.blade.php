@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <div class="container mt-5">
    <ol class="list-group list-group-numbered">
      @foreach ($authors as $author)
        <li class="list-group-item d-flex justify-content-between align-items-start">
          <a href="{{ url('') }}/author/{{ $author->username }}" class="me-auto">{{ $author->name }}</a>      
        </li>
      @endforeach      
    </ol>
  </div>
@endsection
