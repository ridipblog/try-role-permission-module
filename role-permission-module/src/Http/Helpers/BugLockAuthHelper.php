<?php

namespace  BugLock\rolePermissionModule\Http\Helpers;

use BugLock\rolePermissionModule\Models\Role;
use Exception;
use Illuminate\Support\Facades\Auth;

class BugLockAuthHelper
{
    public $process;
    public $auth_message;
    public $auth_user;
    public function __construct($guard = null)
    {
        $this->process = true;
        $this->auth_user = Auth::guard($guard == "web" ? null : $guard);
    }
    // -------------- check logged in ------------
    public function isAuthorized()
    {
        if ($this->auth_user->check()) {
            $this->process = true;
        } else {
            $this->process = false;
            $this->auth_message = "You are not logged in !";
        }
        return $this;
    }
    // ----------- check active user -------------
    public function checkActiveUser()
    {
        if ($this->process) {
            if ($this->auth_user->user()->status == 1) {
                $this->process = true;
            } else {
                $this->process = false;
                $this->auth_message = "Your account is deatived !";
            }
        }
        return $this;
    }

    // -----------------  check given roles with logged user role ------------------
    public function isAuthorizedRole($given_roles)
    {
        // dd($role_name);
        if ($this->process) {
            $given_roles_id = Role::select('id')
                ->whereIn('name', $given_roles)
                ->get()
                ->pluck('id')
                ->toArray();
            dd($given_roles_id);
        }
        return $this;
    }
    // -------------- get roles and permission by user ---------------
    public static function isAuthorizedPermission() {}

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
