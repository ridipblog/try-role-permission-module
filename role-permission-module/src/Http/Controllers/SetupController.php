<?php
namespace BugLock\rolePermissionModule\Http\Controllers;

class SetupController{
    public $role=null;
    public function __construct() {
        
    }
    public function addRole($name){
        $this->role=$name;
        return $this;
    }
    public function showRole(){
        return $this->role;
    }
}