<?php

declare(strict_types=1);

namespace BugLock\rolePermissionModule\Http\Middlewares;

use BugLock\rolePermissionModule\Http\Helpers\BugLockAuthHelper;
use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BugLockAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $guard = null, string $type = "view", string $check_active = "no"): Response
    {
        $auth_helper = null;
        try {
            $auth_helper = new BugLockAuthHelper($guard);
            $auth_helper->isAuthorized();
            if($check_active==="yes"){
                $auth_helper->checkActiveUser();
            }
        } catch (Exception $err) {
            dd($err->getMessage());
        }
        // ***** return process if any unauthorization *****
        $auth_helper->returnProcess($type);

        return $next($request);
    }
}
