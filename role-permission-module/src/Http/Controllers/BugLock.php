<?php

declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Controllers;

use YourVendor\rolePermissionModule\Http\Helpers\AssignLocksHelper;
use YourVendor\rolePermissionModule\Http\Helpers\Helper;
use YourVendor\rolePermissionModule\Http\Helpers\PermissionHelper;
use YourVendor\rolePermissionModule\Http\Helpers\RoleHelper;

class BugLock
{

    public $response = [
        "is_success" => true,
        "error" => null
    ];
    public $latest_roles = [];
    public $latest_permissions = [];
    private $controller = null;

    //global fail check
    public $fails=false;

    //global fail message
    public $reason=null;

    //System Helper trait
    use Helper;

    // used role helper 
    use RoleHelper;

    // used permission helper 
    use PermissionHelper;

    //Used Assign Helper 
    use AssignLocksHelper;
    public function __construct()
    {
        $this->controller = config('role-permission-codes.controllers.assign_role');

        $this->initRoleHelper(); // RoleHelper construtor
        $this->initPermissionHelper(); // PermissionHelper constructor
        $this->initAssignHelper(); // AssignLocksHelper constructor
    }

    // Start Role Section

    //Create role
    public function createRole(...$role)
    {
        $this->addRole($role);
    }

    //all role list
    public function getRoles()
    {
        $this->listRoles();
    }

    // End Role Section

    // Start Permission Section

    //Add New Permissions
    public function createPermission(...$permission)
    {
        $this->addPermission($permission);
    }

    // End Permission Section

    //Start Assign Locks Section

    //Assign locks
    public function assignedLocks(array $roles = [], array $permissions = [])
    {
        $this->assignLocks($roles, $permissions);
    }
    //End Assign Locks Section


}
