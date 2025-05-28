<?php
declare(strict_types=1);

namespace BugLock\rolePermissionModule\Http\Middlewares;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BugLockRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = "web",string $type="view", ...$roles): Response
    {
        
        if($request->logged_user ?? false){
            dd($request->logged_user);
        }
        return $next($request);
    }
}