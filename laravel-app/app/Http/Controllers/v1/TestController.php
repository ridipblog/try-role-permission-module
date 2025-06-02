<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use BugLock\rolePermissionModule\Http\Controllers\BugLock;
use BugLock\rolePermissionModule\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $bug_lock->createRole('admin-1', 'admin-2');
        $bug_lock->createPermission('edit-resume-1', 'remove-resume-2');
        $bug_lock->assignedLocks();
        dd($bug_lock);
    }

    public function dash_1(Request $request){
        dd(Auth::user());
    }
    public function dash_2(Request $request){

    }

    public function dash_3(Request $request){

    }


    public function register(Request $request){
        // $user=User::create([
        //     'name'=>'coder 1',
        //     'email'=>'coder1',
        //     'password'=>Hash::make('password')
        // ]);
        $user=User::where('name','coder 1')
        ->first();
        $user->assignRoleToUser('admin-1');
        $user->assignRoleToUser('admin-2');
        if($user->fails){
            dd($user->reason);
        }
    }
}
