<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*public static function getAdmins()
    {
        $record = Admin::select('id', 'name', 'email')->get()->toArray();
        return $record;
    }

   /* public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function checkPermission($permission)
    {


        $roles = Auth()->user()->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions;

            if ($permissions->contains('name', $permission)) {
                return true;
            }
        }
    }*/

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'admin_role', 'admin_id', 'role_id');
    }
    public static function getUsers()
    {
        $record = User::select('id', 'name', 'email')->get()->toArray();
        return $record;
    }

    public function checkPermission($permission)
    {


        $roles = Auth::guard('admin')->user()->roles;

        foreach ($roles as $role) {
            $permissions = $role->permissions;

            if ($permissions->contains('name', $permission)) {
                return true;
            }
        }
    }
    public function setPasswordAttribute($value)
    {

        $this->attributes['password'] = bcrypt($value);
    }

    public function storeAdminRole($id, array $input)
    {

        $admin = Admin::find($id);

        $admin->roles()->attach($input);
    }
}
