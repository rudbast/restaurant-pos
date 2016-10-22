<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
     * A category can have many menus.
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
