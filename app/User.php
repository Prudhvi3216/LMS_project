<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password',
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

    public function instructor(){
        return $this->hasOne('App\Instructor', 'user_id', 'id');
    }

    public function roles(){
      //if the pivot table name not suitable, pass pivot table name as second aurgement to map.
      return $this->belongsToMany('App\Role');
    }

    //For Socialite
    public function accounts(){
        return $this->hasMany('App\LinkedSocialAccount');
    }

    //User Enrolled Courses
    public function enrolled_courses(){
        return $this->hasMany('App\CourseTaken');
    }
}
