<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
  <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="/dashboard">
          <span data-feather="home" class="align-text-bottom"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        {{-- Diberikan wildcard * yang akan melihat apapun setelah tanda posts --}}
        <a class="nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}" href="/dashboard/posts">
          <span data-feather="file-text" class="align-text-bottom"></span>
            Posts
        </a>
      </li>
    </ul>
    {{-- can bisa digunakan jika sudah membuat GATES --}}
    {{-- admin disini adalah nama gate yang telah dibuat --}}
    @can('admin')
      <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Administrator</span>
      </h6>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a href="/dashboard/categories" class="nav-link {{ Request::is('dashboard/categories*') ? 'active' : ''}}">
            <span data-feather="grid" class="align-text-bottom"></span>
            Post Category
          </a>
        </li>
      </ul>        
    @endcan
  </div>
</nav>