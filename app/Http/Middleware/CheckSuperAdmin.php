<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('admins')->check()) {
            if((Auth::guard('admins')->user()->permission) == 1){
                return $next($request);
            } else {
                return redirect()->to('403');
            }
            
        } else {
            return redirect('admin/login/403');
        }
    }
}
