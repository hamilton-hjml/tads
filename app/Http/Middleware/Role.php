<?php

namespace App\Http\Middleware;

use Closure;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
    */
    
    public function handle($request, Closure $next, $role)
    {
		//don't have role, redirect to login page
		if (!$request->user())
		{
			return redirect('home');
		}
		
        if (!$request->user()->hasRole($role)) {
            // Redirect...
            if ($request->user()->role == 'professor')
            {
				 return redirect('mobile/menuPrincipal');
			}
            
            return redirect('home');
        }

        return $next($request);
    }
}
