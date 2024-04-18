<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class isEditorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Session::get('user')->loai_tai_khoan == 2) {
            return $next($request);
        }

        else if(Session::get('user')->loai_tai_khoan == 3) {
            return redirect()->route('home');
        }

        else return redirect()->route('accounts.management');
    }
}
