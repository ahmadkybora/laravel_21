<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PolicyMiddleware
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
        dd($request->route());
        $access = ['view'];
        switch (Gate::denies('view', $request->user()))
        {
            case 'view':
                return response()->json([
                    'state' => false,
                    'message' => 'access denied',
                    'data' => null,
                ], 403);

            case 'view':
                return response()->json([
                    'state' => false,
                    'message' => 'access denied',
                    'data' => null,
                ], 403);
        }

        return $next($request);
    }
}
