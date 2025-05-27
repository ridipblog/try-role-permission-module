<?php

declare(strict_types=1);

namespace YourVendor\rolePermissionModule\Http\Helpers;

use Exception;
use YourVendor\rolePermissionModule\Models\Permission;
use YourVendor\rolePermissionModule\Models\Role;

trait databaseHelper
{
    public $helper_query = null;

    //all holders model
    private function holders()
    {
        return [
            'roles' => new Role(),
            'permissions' => new Permission()
        ];
    }

    //Get roles data
    public function setHolders(string $model, array $columns = [])
    {
        try {
            $model = $this->holders()[$model];
            $this->helper_query = $model::query();
            if (count($columns) != 0) {
                $this->helper_query->select(implode(',', $columns));
            }
            $this->fails = false;
        } catch (Exception $err) {
            $this->fails = true;
            $this->reason = "Error in getHolders Method : " . $err->getMessage();
        }
        return $this;
    }

    //Add where condition 
    public function byRoleName(array $roles = [])
    {
        if (!$this->fails) {
            $this->helper_query->whereIn('name', $roles);
        }
        return $this;
    }

    //Get values 
    public function getHelpers(string $all = 'all')
    {
        if (!$this->fails) {
            try {
                $data = null;
                if ($all == 'first') {
                    $data = $this->helper_query->first();
                } else {
                    $data = $this->helper_query->get();
                }
                $this->fails = false;
                $this->helper_query=null;
                return $data;
            } catch (Exception $err) {
                $this->fails = true;
                $this->reason = "Error in getHelpers method : " . $err->getMessage();
            }
        }
        return $this;
    }
}
