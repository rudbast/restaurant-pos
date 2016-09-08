<?php

use App\User;
use App\Access;
use Illuminate\Database\Seeder;

class AccessUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('access_user')->delete();
        DB::table('access_user')->insert([
            'user_id' => User::first()->id,
            'access_id' => Access::first()->id
        ]);
    }
}
