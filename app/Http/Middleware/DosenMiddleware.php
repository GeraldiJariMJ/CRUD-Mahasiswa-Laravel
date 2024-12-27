<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DosenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //jika dibutuhkan

        // if(!empty(Auth::check())){
        //     if(Auth::user()->role == 'dosen'){
        //         return $next($request);
        //     }else{
        //         Auth::logout();
        //         return redirect(url(''));
        //     }
        // }
        // Auth::logout();
        // return redirect(url(''));

        if (Auth::user()->role != 'dosen'){
            // return redirect('dashboard');
            
            Auth::user()->role = 'admin';
            return redirect(Auth::user()->role.'/dashboard');
        }
        // if (Auth::user()->usertype != 'user'){
        //     return redirect('admin/dashboard');
        // }
        return $next($request);
    }
}
