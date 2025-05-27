<?php

namespace BugLock\rolePermissionModule\Http\Middlewares;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BugLockAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = null, array ...$assign_name): Response
    {
        
        dd($request);
        return $next($request);
    }
}