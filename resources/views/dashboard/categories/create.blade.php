@extends('dashboard.layouts.main')
@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Category</h1>
  </div>
  <div class="mb-3">
    <a href="/dashboard/categories" class="btn btn-success">
      <span data-feather="arrow-left"></span>
      Back
    </a>
  </div>
  <div class="col-lg-8">
    <form action="/dashboard/categories" method="POST">
      @csrf
      <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" name="name" value="{{ old('name') }}"
          class="form-control @error('name') is-invalid @enderror" id="name" autofocus autocomplete="off">
        @error('name')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input type="text" name="slug" value="{{ old('slug') }}"
          class="form-control @error('slug') is-invalid @enderror" id="slug" readonly>
        @error('slug')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
  </div>

  <script>
    const name = document.querySelector('#name');
    const slug = document.querySelector('#slug');

    name.addEventListener('change', function() {
      fetch(`/dashboard/categories/createSlug?category=${name.value}`)
        .then(response => response.json())
        .then(data => slug.value = data.slug);
    });

    document.addEventListener('trix-file-accept', function(e) {
      e.preventDefault();
    });
  </script>
@endsection
