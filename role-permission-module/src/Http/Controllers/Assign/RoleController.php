<?php

namespace YourVendor\rolePermissionModule\Http\Controllers\Assign;

use Exception;
use YourVendor\rolePermissionModule\Models\Role;

class RoleController
{
    public $response = [
        "is_success" => true,
        "error" => null
    ];
    public $role = null;
    private $controller = null;
    public function __construct()
    {
        $this->controller = config('role-permission-codes.controllers.assign_role');
    }

    //Add new role
    public function addRole($role)
    {
        if ($role) {
            try {
                Role::create([
                    'name' => $role
                ]);
                $this->response['is_success'] = true;
                $this->role = $role;
            } catch (Exception $err) {
                $this->response['is_success'] = false;
                $this->response['error'] = "{$err->getMessage()}";
                logger("Error in {$this->controller}: {$err->getMessage()}");
            }
        } else {
            $this->response['is_success'] = false;
            $this->response['error'] = "Undefine role name";
            logger(`Error for {$this->controller} :  $this->response['error']`);
        }
    }

    //List of all roles
    public function listRoles()
    {
        try {
            $this->response['roles'] = Role::get();
            $this->response['is_success'] = true;
            return $this;
        } catch (Exception $err) {
            $this->response['is_success'] = false;
            $this->response['error'] = "{$err->getMessage()}";
            logger("Error in {$this->controller}: {$err->getMessage()}");
        }
    }
}
