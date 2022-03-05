<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBearer
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->bearerToken() === config('app.bearer'), Response::HTTP_FORBIDDEN);

        return $next($request);
    }
}
