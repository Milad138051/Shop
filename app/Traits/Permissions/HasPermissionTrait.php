<?php

namespace App\Traits\Permissions;


use App\Models\User\Permission;
use App\Models\User\Role;

trait HasPermissionTrait
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function hasPermission($permission)
    {
        // dd($permission);
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission)
    {
        return $this->hasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role)
        {
            if($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }







}