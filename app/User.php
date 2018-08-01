<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Activitylog\Traits\LogsActivity;


class User extends Authenticatable
{
    use Notifiable;
    use LogsActivity;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    protected static $logAttributes = ['name', 'image'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($name)
    {
        foreach ($this->roles as $role) {
            if ($role->name == $name) return true;
        }
        return false;
    }
}
