<?php

declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Helpers;

use Exception;
use YourVendor\rolePermissionModule\Models\Permission;
use YourVendor\rolePermissionModule\Models\Role;

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
