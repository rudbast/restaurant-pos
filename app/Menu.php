<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price',
    ];

    /**
     * A menu belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
