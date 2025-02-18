<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isAdmin
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next)
  {
    /** 
     * auth()->guest() : true jika merupakan guest
     * auth()->check() : true jika sudah login
    */
    if (!auth()->check() || !auth()->user()->is_admin) {
      abort(403);
    }

    return $next($request);
  }
}
