<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::insert([
            'name' => '用户',
            'username' =>'admin',
            'password' => bcrypt('123456')
        ]);
    }
}
