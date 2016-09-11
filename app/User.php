<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'name', 'email', 'password',
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
     * Get the accesses of the associated user.
     */
    public function accesses()
    {
        return $this->belongsToMany(Access::class);
    }

    /**
     * Check whether current account is admin.
     *
     * @return boolean
     */
    public function isAdmin()
    {
        return DB::table('access_user')
            ->whereAccessId(Access::where('name', Access::ADMIN)->first()->id)
            ->whereUserId($this->id)
            ->count() > 0;
    }

    /**
     * Check whether current account can view report.
     *
     * @return boolean
     */
    public function isReport()
    {
        return DB::table('access_user')
            ->whereAccessId(Access::where('name', Access::SALES)->first()->id)
            ->whereUserId($this->id)
            ->count() > 0;
    }

    /**
     * Mutator for password (hash).
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
