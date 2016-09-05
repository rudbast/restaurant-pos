<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
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
     * Get the staff profile associated with user.
     */
    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    /**
     * Get the name of the user.
     *
     * @param  string $value
     * @return string
     */
    public function getNameAttribute($value)
    {
        return $this->staff->name;
    }

    /**
     * Get the role name of the user.
     *
     * @param  string $value
     * @return string
     */
    public function getRoleAttribute($value)
    {
        return $this->staff->role->name;
    }
}
