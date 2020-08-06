<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value){
       $this->attributes['password'] = bcrypt($value);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);

    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function userHasRole($role_name){

        foreach($this->roles as $role){
            if(Str::lower($role_name) == Str::lower($role->name))
                return true;
        }
        return false;
    }

    /* accessor returns data and does not edit value before going into db but the naming conversion where 'get' specifies that
    it is an accessor and 'avatar' is the name of the field
*/
    public function getAvatarAttribute($value){
        if(Str::contains($value, "http"))
            return asset($value);
        else
            return asset("storage/".$value);

    }
}
