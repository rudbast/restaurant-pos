<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * Manage users & sales report.
     */
    const ADMIN = 'Pengelola';

    /**
     * Manage orders (incoming).
     */
    const WAITER = 'Pelayan';

    /**
     * Manage payment.
     */
    const CASHIER = 'Kasir';

    /**
     * Manage orders to be served (kitchen / bar).
     */
    const MONITOR = 'Monitor';

    /**
     * Manage menu & stock.
     */
    const INVENTORY = 'Inventaris';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all staffs of a certain role.
     */
    public function staffs()
    {
        return $this->hasMany(Staff::class);
    }
}
