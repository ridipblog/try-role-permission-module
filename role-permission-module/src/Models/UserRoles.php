<?php

namespace BugLock\rolePermissionModule\Models;

use Illuminate\Database\Eloquent\Model;

class UserRoles extends Model
{
    protected $table = 'user_roles';

    protected $fillable = [
        'user_id',
        'role_id'
    ];
    
    public function roles(){
        return $this->belongsTo(Role::class,'role_id');
    }
}
