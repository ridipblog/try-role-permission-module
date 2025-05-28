<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use BugLock\rolePermissionModule\Http\Controllers\BugLock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function login(Request $request){
        Auth::attempt([
            'name'=>'coder 1',
            'password'=>'password'
        ]);
    }
    public function logout(Request $request){
        Auth::logout();
    }
    //Role functionalities
    public function check_1(Request $request)
    {
        $bug_lock = new BugLock();
        $bug_lock->createRole('admin-3', 'admin-4');
        $bug_lock->createPermission('edit-resume-1', 'remove-resume-2');
        $bug_lock->assignedLocks();
        dd($bug_lock);
    }

    public function dash_1(Request $request){
        dd(Auth::user());
    }
    public function dash_2(Request $request){
        dd($request->logged_user);
    }
}
