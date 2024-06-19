<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="#">
      <iframe src="https://giphy.com/embed/NVBR6cLvUjV9C" width="40px" height="40px" frameBorder="0" class="mt-1"
        allowFullScreen></iframe>    
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-5">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('posts') ? 'active' : '' }}" href="/posts">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Categories</a>
        </li>
      </ul>
      {{-- Jika sudah login --}}
      <ul class="navbar-nav fs-5">
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Hai, {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/dashboard">
              <i class="bi bi-file-ruled-fill me-2"></i>
              Dashboard
            </a></li>            
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout" method="POST">
                @csrf                
                <button type="submit" class="dropdown-item">
                  <i class="bi bi-box-arrow-left me-2"></i>
                  Logout
                </button>
              </form>
            </li>
          </ul>
        </li>
      @else           
        <li class="nav-item">
          <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="/login">
            <i class="bi bi-box-arrow-in-right"></i>
            Login
          </a>
        </li>
      @endauth
      </ul>
    </div>
  </div>
</nav>
