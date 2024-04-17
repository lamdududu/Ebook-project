<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Account;
use Illuminate\Support\Facades\Session;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     $account = Account::find(Session::get('userName'));

    //     if($account->isAdmin()) {
    //         return redirect()->route('accounts.management');
    //     }

    //     else if($account->isEditor()) {
    //         return redirect()->route('works.management');
    //     }

    //     else {
    //         return redirect()->route('home');
    //     }     
    // }
}
