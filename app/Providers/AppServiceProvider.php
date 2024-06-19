<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    // Jika pagination laravel menggunakan bootstrap
    // karena defaultnya pakai tailwind
    Paginator::useBootstrap();

    /**
     * INI ADALAH MEMBUAT GATE
     * 
     * Nama Gate nya bebas (bukan berarti harus sama dengan middleware ya)      
    */    
    Gate::define('admin', function(User $user){
      // yang dikondisikan
      // diasumsikan 1: true, 0:false
      return $user->is_admin;
    });
  }
}
