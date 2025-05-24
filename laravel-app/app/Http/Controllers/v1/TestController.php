<?php
declare(strict_types=1);

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;

use Exception;
use Illuminate\Http\Request;
use YourVendor\rolePermissionModule\Http\Controllers\Assign\RoleController;
use YourVendor\rolePermissionModule\Http\Controllers\BugLock;
use YourVendor\rolePermissionModule\Http\Controllers\SetupController;

class TestController extends Controller
{
    public function test1(Request $request)
    {
        $set_up = new SetupController();

        return $set_up->addRole("Admin")->showRole();
    }
    //Role functionalities
    public function checkRole()
    {
        $bug_lock = new BugLock();
        $bug_lock->createRole('admin-1','admin-2');
        $bug_lock->createPermission('edit-easy-1','remove-easy-2');
        $bug_lock->assignedLocks();
        if ($bug_lock->response['is_success']) {
            $bug_lock->getRoles();
            return $bug_lock->response['roles'];
        } else {
            return $bug_lock->response['error'];
        }
    }
}
