<?php
declare(strict_types=1);

namespace BugLock\rolePermissionModule\Http\Middlewares;

use BugLock\rolePermissionModule\Http\Helpers\BugLockAuthHelper;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BugLockPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = "web",string $type="view", ...$given_permissions): Response
    {
        $auth_helper = null;
        try {
            $auth_helper = new BugLockAuthHelper($guard);
            $auth_helper->isAuthorized()
            ->isAuthorizedPermission($given_permissions);
        } catch (Exception $err) {
            dd($err->getMessage());
        }
        // ***** return process if any unauthorization *****
        $auth_helper->returnProcess($type);
        
        return $next($request);
    }
}