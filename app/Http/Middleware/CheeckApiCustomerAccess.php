<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheeckApiCustomerAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    if(Auth::guard('sanctum')->check() && Auth::guard('sanctum')->user()->type === 'customer'){
         return $next($request);
    }
    return response()->json([
            'message' => 'Unauthorized. Only customers can access this resource.'
        ], 403);
// هون ماحطيت abortلانو بترجعلي الabort غلط عبارة عن html فحطيتو json مشان اعرف الغلط بالapi
    }
}
