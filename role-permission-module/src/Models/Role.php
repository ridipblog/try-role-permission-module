<?php

namespace BugLock\rolePermissionModule\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    // get Table Name 
    public function getTableName()
    {
        return $this->table;
    }

    //Get Columns Name
    public function getColumnsName()
    {
        $columns = $this->fillable;
        return array_push($columns, 'id');
    }
}
