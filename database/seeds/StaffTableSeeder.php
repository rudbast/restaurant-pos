<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff')->delete();
        DB::table('staff')->insert([
            'user_id' => 1,
            'role_id' => 1,
            'name' => 'Admin',
        ]);
    }
}
