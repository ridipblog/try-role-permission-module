<?php

declare(strict_types=1);

namespace BugLock\rolePermissionModule\Http\Helpers;

use Exception;
use BugLock\rolePermissionModule\Models\Permission;
use BugLock\rolePermissionModule\Models\Role;

trait Helper
{
        
    //Convert Role and Permission Format
    private function convertFormat(array $arr)
    {
        return collect($arr)->map(function ($item) {
            return [
                'name' => $item
            ];
        })->toArray();
    }
}
