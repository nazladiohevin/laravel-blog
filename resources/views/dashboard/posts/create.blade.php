@extends('dashboard.layouts.main')
@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Post</h1>
  </div>
  <div class="mb-3"> 
    <a href="/dashboard/posts" class="btn btn-success">
      <span data-feather="arrow-left"></span>
      Back
    </a>     
  </div>
  <div class="col-lg-8">
    <form action="/dashboard/posts" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" id="title" autofocus>
        @error('title')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" value="{{ old('slug') }}" class="form-control @error('slug') is-invalid @enderror" id="slug" readonly>
        @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="category" class="form-label">Category</label>
        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
          @foreach ($categories as $category)
            <option @if(old('category_id') == $category->id) selected @endif  
              value="{{ $category->id }}">{{ $category->name }}</option>                            
          @endforeach          
        </select>
        @error('category_id')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        {{-- input file tak bisa diberikan method old() karena masalah keamanan --}}
        <label for="image" class="form-label">Post Image</label>
        <img class="img-preview img-thumbnail mb-3 col-lg-7">
        <input class="form-control @error('image') is-invalid @enderror" 
          name="image" type="file" id="image" onchange="previewImage()">
        @error('image')
          <div class="invalid-feedback">
            {{ $message }}
          </div>                
        @enderror        
      </div>
      <div class="mb-3">
        <label class="form-label">Content</label>
        @error('content')
          <p class="text-danger">{{ $message }}</p>
        @enderror
        <input id="body" type="hidden" name="content" value="{{ old('content') }}">
        <trix-editor input="body"></trix-editor>
      </div>
      <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
  </div>

  <script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function(){
      fetch(`/dashboard/posts/createSlug?title=${title.value}`)
        .then(response => response.json())
        .then(data => slug.value = data.slug); 
    });

    document.addEventListener('trix-file-accept', function(e){
      e.preventDefault();
    });
  </script>
@endsection
