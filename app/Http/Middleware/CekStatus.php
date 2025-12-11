<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CekStatus
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
        if(Auth::user()->verify == 0 ){
            Auth::logout();
            alert()->warning('Akun Terdaftar',
                            'Silahkan hubungi administrator untuk aktivasi akun anda agar bisa masuk');
            return redirect()->back();
        }


        return $next($request);
    }
}
