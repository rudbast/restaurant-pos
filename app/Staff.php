<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get user account associated with staff.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the role of associated staff.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
