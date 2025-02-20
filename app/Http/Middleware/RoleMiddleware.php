<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!$request->user()) {
            return redirect()->route('login');
        }
        if(!in_array($request->user()->role, $roles)) {
//            dd("Unauthorized role");
            abort(Response::HTTP_FORBIDDEN, "Unauthorized");
        }
        return $next($request);
    }
}
