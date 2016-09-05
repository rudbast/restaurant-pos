<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@thegrapes.com',
            'password' => bcrypt('admin')
        ]);
    }
}
