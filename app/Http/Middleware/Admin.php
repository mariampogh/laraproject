<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Role;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $admin_role_id = Role::where('name','admin')->first()->id;
      if(Auth::check() && Auth::User()->role == $admin_role_id) {
            return $next($request);
        }
        return redirect('/home');
    }
}
