<?php
declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Helpers;

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
