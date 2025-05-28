<?php

namespace  BugLock\rolePermissionModule\Http\Helpers;

use Illuminate\Support\Facades\Auth;

class BugLockAuthHelper
{
    public $process;
    public $auth_message;
    public $auth_user;
    public function __construct($guard = null)
    {
        $this->process = true;
        $this->auth_user = Auth::guard($guard == "web" ? null :$guard);
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
    public function isAuthorizedRole($role_name)
    {
        // dd($role_name);
        if ($this->process) {
            if (in_array($this->auth_user->user()->roles->name, $role_name)) {
                $this->process = true;
            } else {
                $this->process = false;
                $this->auth_message = "Your Role is authorized !";
            }
        }
        return $this;
    }
    // -------------- get roles and permission by user ---------------
    public static function isAuthorizedPermission()
    {
                
    }
}
