<?php

namespace App;

use App\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'phone', 'password','intern_contact', 'company_name', 'company_address', 'company_postal_code', 'company_city', 'intervention_domain', 'first_connection',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getName($id)
    {
        $user = User::find($id);

        return $user->first_name.' '.$user->last_name;
    }

    public function isAdmin()
    {
        return $this->hasRole('Admin');
    }

    public function isTech()
    {
        return $this->hasRole('Technicien');
    }

    public function isClient()
    {
        return $this->hasRole('Client');
    }

    public function isPlanneur()
    {
        return $this->hasRole('Planneur');
    }

    public function isFM()
    {
        return $this->hasRole('FM');
    }

    public function isManager()
    {
        return $this->hasRole('Manager');
    }

    public function isExternContact()
    {
        return $this->hasRole('Contact Externe');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'user_roles', 'user_id', 'role_id');
    }

    public function sites()
    {
        return $this->belongsToMany('App\Models\Site', 'user_sites', 'user_id', 'site_id');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles))
        {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public static function getRoles($id)
    {
        $roles = UserRole::where('user_id', $id)->get();
        if ($roles) {
            return $roles;
        }
        return false;
    }

    public static function getTechs()
    {
        $AllUsers = User::all();

        $users = array();
        foreach($AllUsers as $user) {
            if($user->hasRole('Technicien')) {
                $users[$user->id]    = $user->first_name.' '.$user->last_name;
            }
        }
        return $users;
    }

    public static function getUsersName()
    {
        $AllUsers = User::all();

        $users = array();
        foreach($AllUsers as $user) {
            $users[$user->id]    = $user->first_name.' '.$user->last_name;
        }
        return $users;
    }

    public static function getAssigned()
    {
        $AllUsers = User::all();

        $assigned = array();
        foreach($AllUsers as $user) {

            $role = DB::table('roles')->join('user_roles', 'roles.id', '=', 'user_roles.role_id')
            ->where('user_id',$user->id)->first();

            $assigned[$user->id]    = $role->name.' - '. $user->first_name.' '.$user->last_name;
        }
        //sort($assigned, SORT_STRING);
        return $assigned;
    }

    public static function getInternContacts()
    {
        $externRole = Role::where('name','Contact Externe')->first();        

        $users = DB::table('users')->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'roles.id', '=', 'user_roles.role_id')
            ->where('role_id', '!=', $externRole->id)
            ->select('user_id', 'first_name', 'last_name', 'email', 'role_id', 'name')->get();

        return $users;
    }

    public static function getExternContacts($id)
    {
        $users = DB::table('users')->join('user_sites', 'users.id', '=', 'user_id')->where('intern_contact', 0)->where('site_id', $id)->get();

        return $users;
    }

    public static function getAll() {

        $users = DB::table('users')->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'roles.id', '=', 'user_roles.role_id')
            ->select('user_id', 'first_name', 'last_name', 'email', 'role_id', 'name', 'map_creator')->get();

        return $users;
    }
}
