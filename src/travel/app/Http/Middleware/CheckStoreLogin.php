<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreLogin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->session()->has('sid')) {

            return response()->json(['errorMessage' => 'Unauthorized'], 401);

        }

        return $next($request);

    }
}
