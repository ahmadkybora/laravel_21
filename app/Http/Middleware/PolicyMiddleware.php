<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        // $resp = response()->json([
        //     'state' => false,
        //     'message' => __('general.accessDenied'),
        //     'data' => null,
        // ], 403);

        // switch($request->route()->getName())
        // {
            // case 'users.index':
            //     if(Gate::denies('view-any', User::class))
            //     // break;
            //     return $resp;

            // case 'users.create':
            //     if(!Gate::denies('create', $request->user()))
            //     break;

            // case 'users.show':
            //     if(!Gate::denies('view', $request->user()))
            //     break;

            // case 'users.edit':
            //     if(!Gate::denies('view', $request->user()))
            //     break;

            // case 'users.update':
            //     if(!Gate::denies('update', $request->user()))
            //     break;

            // case 'users.destroy':
            //     if(!Gate::denies('delete', $request->user()))
            //     break;

        //     default;
        // }

        return $next($request);
    }
}
