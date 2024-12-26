<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (!$request->session()->has('cid')) {

            return response()->json(['errorMessage' => 'Unauthorized'], 401);

        }

        return $next($request);

    }
}
