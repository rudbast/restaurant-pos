<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        DB::table('roles')->insert([
            [ 'id' => 1, 'name' => Role::ADMIN ],
            [ 'id' => 2, 'name' => Role::CASHIER ],
            [ 'id' => 3, 'name' => Role::INVENTORY ],
            [ 'id' => 4, 'name' => Role::MONITOR ],
            [ 'id' => 5, 'name' => Role::WAITER ],
        ]);
    }
}
