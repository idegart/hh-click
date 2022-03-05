<?php

namespace App\Http\Middleware;

use App\Jobs\Activity\SendActiveRoute;
use Closure;
use Illuminate\Http\Request;

class Activity
{
    public function handle(Request $request, Closure $next)
    {
        dispatch(
            new SendActiveRoute(
                $request->fullUrl(),
            )
        );

        return $next($request);
    }
}
