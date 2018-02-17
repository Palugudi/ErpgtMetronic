<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
    	return $this->belongsToMany('App\User', 'user_roles', 'role_id', 'user_id');
    }

    public static function getName($id)
    {
		$role = Role::where('id', $id)->first();
		if ($role) {
            $role_name = $role->name;
            return $role_name;
        }
        return false;
	}

    public static function getList()
    {
        // Lister les roles / statut
        $Roles = Role::where('name', '!=', 'Admin')->where('intern_role', '!=', '0')->get();
        $stat = array();
        foreach($Roles as $Role) {
            $stat[$Role->id] = $Role->name;
        }
        return $stat;
    }

    public static function getAll() 
    {
        $Roles = Role::where('name', '!=', 'Admin')->where('intern_role', '!=', '0')->get();
        return $Roles;
    }

    public static function getExtern()
    {
        $role = Role::where('intern_role', '=', '0')->first();
        return $role;
    }
}

