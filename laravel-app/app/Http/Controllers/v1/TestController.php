<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use BugLock\rolePermissionModule\Http\Controllers\BugLock;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //Role functionalities
    public function check_1(Request $request)
    {
        $bug_lock = new BugLock();
        $bug_lock->createRole('admin-3', 'admin-4');
        $bug_lock->createPermission('edit-resume-1', 'remove-resume-2');
        $bug_lock->assignedLocks();
        dd($bug_lock);
    }
}
