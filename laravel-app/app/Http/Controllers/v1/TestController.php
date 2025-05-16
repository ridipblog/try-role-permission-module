<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use YourVendor\rolePermissionModule\Http\Controllers\SetupController;

class TestController extends Controller
{
    public function test1(Request $request){
        $set_up=new SetupController();
        return $set_up->addRole("Admin")->showRole();
    }
}
