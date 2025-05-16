<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use YourVendor\rolePermissionModule\Http\Controllers\Assign\RoleController;
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
        $role = new RoleController();

        $role->addRole('user');
        if ($role->response['is_success']) {
            return $role->listRoles()->response['roles'];
        } else {
            return $role->response['error'];
        }
    }
}
