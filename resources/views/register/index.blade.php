@extends('layouts.main')
@section('title')
  {{ $title }}
@endsection
@section('container')
  <div class="container mt-3">
    <main class="form-signin w-100 m-auto">
      <form action="/register" method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal">REGISTER</h1>
        <div class="form-floating">
          <input type="text" name="name" value="{{ old("name") }}" 
            class="form-control @error('name') is-invalid @enderror" placeholder="Input name..." autofocus required>
          <label>Name</label>
          @error('name')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" name="username" value="{{ old("username") }}" 
            class="form-control @error('username') is-invalid @enderror" placeholder="Input username..." required>
          <label>Username</label>
          @error('username')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="email" name="email" value="{{ old("email") }}" 
            class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" required>
          <label>Email</label>
          @error('email')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" value="{{ old("password") }}" 
            class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
          <label>Password</label>
          @error('password')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
          @enderror
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