@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <div class="container mt-3">
    <main class="form-signin w-100 m-auto">
      @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">          
          <strong>{{ session('success') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      @if(session()->has('loginError'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">          
          <strong>{{ session('loginError') }}</strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      @endif
      <form action="/login" method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal">LOGIN</h1>
        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
            id="email" placeholder="name@example.com" value="{{ old('email') }}" autofocus required>
          <label for="email">Email address</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>
        {{-- <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div> --}}
        <button class="w-100 btn btn-lg btn-primary my-3" type="submit">Login</button>
        <small>Don't have an account? <a href="/register">Register</a></small>
      </form>
    </main>
  </div>
@endsection