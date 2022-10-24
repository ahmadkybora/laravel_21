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
        switch($request->route()->getName())
        {
            case 'user-index':
                if(!Gate::denies('view', $request->user()))
                    return response()->json([
                        'state' => false,
                        'message' => __('general.accessDenied'),
                        'data' => null,
                    ], 403);

            default;
        }

        return $next($request);
    }
}
