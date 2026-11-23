<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheeckDashboardAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && in_array(Auth::user()->type,['super_admin','employee'])){
            return $next($request);
        }

        abort(403,'Unauthorized access to dashboard.');
        // بوقفلي الكود بستخدمو بالكونترولر او ميدلوير

    }
}
