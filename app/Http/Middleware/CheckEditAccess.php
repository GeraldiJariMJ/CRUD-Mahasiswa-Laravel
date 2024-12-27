<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEditAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $mahasiswa = Mahasiswa::where('user_id', auth()->id())->firstOrFail();

        if (!$mahasiswa->edit) {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses untuk mengedit data.');
        }

        return $next($request);
    }
}
