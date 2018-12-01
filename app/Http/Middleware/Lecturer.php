<?php

namespace App\Http\Middleware;

use Closure;

class Lecturer
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
        $current_path=$request->path();
        if (!$request->session()->has('lecturer_logged_in')){
           return redirect()->action('Lecturer@login');
        }

        return $next($request);
    }
}
