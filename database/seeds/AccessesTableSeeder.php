<?php

use App\Access;
use Illuminate\Database\Seeder;

class AccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accesses')->delete();
        DB::table('accesses')->insert([
            [ 'name' => Access::ADMIN ],
            [ 'name' => Access::SALES ],
            [ 'name' => Access::WAITER ],
            [ 'name' => Access::CASHIER ],
            [ 'name' => Access::MONITOR ],
            [ 'name' => Access::INVENTORY ],
        ]);
    }
}
