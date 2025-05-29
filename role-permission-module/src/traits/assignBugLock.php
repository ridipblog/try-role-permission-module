<?php

declare(strict_types=1);

namespace BugLock\rolePermissionModule\traits;

trait assignBugLock{
    public $fails=false;
    public $reason=null;
    use assignRole;
    
}