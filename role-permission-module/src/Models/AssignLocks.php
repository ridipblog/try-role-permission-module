<?php

namespace BugLock\rolePermissionModule\Models;

use Illuminate\Database\Eloquent\Model;

class AssignLocks extends Model
{
    protected $table = 'assign_locks';

    protected $fillable = [
        'role_id',
        'permission_id'
    ];

    //Connect Relationship with Role Table
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    //Connect Relationship with Permission Table
    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
