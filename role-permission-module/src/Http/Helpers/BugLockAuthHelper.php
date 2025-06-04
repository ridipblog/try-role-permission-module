<?php

declare(strict_types=1);

namespace  BugLock\rolePermissionModule\Http\Helpers;

use BugLock\rolePermissionModule\Models\AssignLocks;
use BugLock\rolePermissionModule\Models\Role;
use BugLock\rolePermissionModule\Models\UserRoles;
use Exception;
use Illuminate\Support\Facades\Auth;

class BugLockAuthHelper
{
    public $process;
    public $auth_message;
    public $auth_user;
    public $auth_info;
    public $page;
    public function __construct($guard = 'web')
    {
        $this->process = true;
        $this->auth_user = Auth::guard($guard);
        $this->auth_info = $this->auth_user->user();
        $this->page=null;
    }
    // -------------- check logged in ------------
    public function isAuthorized()
    {
        if ($this->auth_user->check()) {
            $this->process = true;
        } else {
            $this->process = false;
            $this->page='auth';
            $this->auth_message = config('buglocks.middleware.error.unauthorized');
        }
        return $this;
    }
    // ----------- check active user -------------
    public function checkActiveUser()
    {
        if ($this->process) {
            if ($this->auth_info?->status == 1) {
                $this->process = true;
            } else {
                $this->process = false;
                $this->page='auth';
                $this->auth_message = config('buglocks.middleware.error.unauthorized-active');
            }
        }
        return $this;
    }

    // -----------------  check given roles with logged user role ------------------
    public function isAuthorizedRole(array $given_roles)
    {
        if ($this->process) {

            $user_id = $this->auth_info[config('buglocks.primary_key')] ?? null;

            $check_roles = UserRoles::query()
                ->where('user_id', $user_id)
                ->whereHas('roles', function ($query) use ($given_roles) {
                    $query->whereIn('name', $given_roles);
                })->exists();

            if (!$check_roles) {
                $this->process = false;
                $this->page='role';
                $this->auth_message = config('buglocks.middleware.error.unauthorized-role');
            }
        }
        return $this;
    }
    // -------------- get roles and permission by user ---------------
    public function isAuthorizedPermission(array $given_permissions)
    {
        if ($this->process) {
            $user_id = $this->auth_info[config('buglocks.primary_key')] ?? null;

            $check_permissios = AssignLocks::query()
                ->whereIn('role_id', function ($query) use ($user_id) {
                    $query->select('role_id')
                        ->from('user_roles')
                        ->where('user_id', $user_id);
                })
                ->whereHas('permissions', function ($query) use ($given_permissions) {
                    $query->whereIn('name', $given_permissions);
                })->exists();

            if (!$check_permissios) {
                $this->process = false;
                $this->page='permissions';
                $this->auth_message = config('buglocks.middleware.error.unauthorized-permission');
            }
        }
        return $this;
    }

    // ***** return process *****
    public function returnProcess($type)
    {
        if ($type === "view") {
            if (!$this->process) {
                return redirect()->route('buglocks.error', ['page' =>$this->page])
                ->with('message',$this->auth_message);
            }
        } else if ($type === "api") {
            if (!$this->process) {
                return response()->json([
                    'status' => 401,
                    'message' => $this->auth_message ?? null
                ], 401);
            }
        } else {
            throw new Exception("Type must be view or api");
        }
    }
}
