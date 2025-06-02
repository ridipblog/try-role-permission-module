<?php

declare(strict_types=1);

namespace  BugLock\rolePermissionModule\Http\Helpers;

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
    public function __construct($guard = null)
    {
        $this->process = true;
        $this->auth_user = Auth::guard($guard == "web" ? null : $guard);
        $this->auth_info = $this->auth_user->user();
    }
    // -------------- check logged in ------------
    public function isAuthorized()
    {
        if ($this->auth_user->check()) {
            $this->process = true;
        } else {
            $this->process = false;
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
                $this->auth_message = config('buglocks.middleware.error.unauthorized-active');
            }
        }
        return $this;
    }

    // -----------------  check given roles with logged user role ------------------
    public function isAuthorizedRole(array $given_roles)
    {
        if ($this->process) {
            $one_to_many_role = config('buglocks.one-to-many-man');
            $query = UserRoles::query()
                ->with(['roles'])
                ->select('role_id')
                ->where('user_id', $this->auth_info[config('buglocks.primary_key')] ?? null);

            if ($one_to_many_role) {
                $user_roles = $query->get()->pluck('roles.name')->toArray();
                if (empty(array_intersect($user_roles, $given_roles))) {
                    $this->process = false;
                    $this->auth_message = config('buglocks.middleware.error.unauthorized-role');
                }
            } else {
                $user_role = $query
                    ->first()?->roles?->name;
                if (!in_array($user_role, $given_roles)) {
                    $this->process = false;
                    $this->auth_message = config('buglocks.middleware.error.unauthorized-role');
                }
            }
        }
        return $this;
    }
    // -------------- get roles and permission by user ---------------
    public function isAuthorizedPermission(array $given_permissions) {
        if($this->process){
            $one_to_many_role = config('buglocks.one-to-many-man');
            $query=UserRoles::select('role_id')
            ->where('user_id', $this->auth_info[config('buglocks.primary_key')] ?? null);
            if($one_to_many_role){
                $user_roles=$query->pluck('role_id')
                ->toArray();
                dd($user_roles);
            }else{
                $user_role=$query->first()?->role_id;
            }
        }
        return $this;
    }

    // ***** return process *****
    public function returnProcess($type)
    {
        if ($type === "view") {
            if (!$this->process) {
                dd($this->auth_message);
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
