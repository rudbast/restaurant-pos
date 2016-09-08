<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    /**
     * Manage various settings.
     */
    const ADMIN = 'Pengelola';

    /**
     * Manage sales report.
     */
    const SALES = 'Laporan';

    /**
     * Manage incoming orders.
     */
    const WAITER = 'Pelayan';

    /**
     * Manage payment.
     */
    const CASHIER = 'Kasir';

    /**
     * Process orders (kitchen / bar).
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
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
