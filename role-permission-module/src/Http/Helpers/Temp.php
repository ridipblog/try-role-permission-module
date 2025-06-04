<?php

use BugLock\rolePermissionModule\Models\UserRoles;

class Temp
{
    private function isAuthorizedRole(array $given_roles)
    {
        $one_to_many_role = config('buglocks.one-to-many-man');
        $query = UserRoles::query()
            ->with(['roles'])
            ->select('role_id')
            ->where('user_id', $this->auth_info[config('buglocks.primary_key')] ?? null);

        if ($one_to_many_role) {
            $query = UserRoles::query()
                ->with(['roles'])
                ->select('role_id')
                ->where('user_id', $this->auth_info[config('buglocks.primary_key')] ?? null);
            $user_roles = $query->get()->pluck('roles.name')->toArray();
            if (empty(array_intersect($user_roles, $given_roles))) {
                dd("Not OK");
            } else {
                dd("Ok");
            }
        } else {
            $user_role = $query
                ->first()?->roles?->name;
            if (!in_array($user_role, $given_roles)) {
                
            }
        }
    }
}
