<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasRoles, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','lastname','gender','birthdate','phone',
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

    public function specialities()
    {
        return $this->belongsToMany('App\Speciality');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course');
    }

    public function schedules()
    {
        return $this->hasMany('App\Schedule');
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
    
    public function procedures()
    {
        return $this->belongsToMany('App\Procedure');
    }
    /**
     * Get the first name of the User
     */
    public function getFirstNameAttribute($value)
    {
        return explode(' ', $this->name)[0];
    }
}
