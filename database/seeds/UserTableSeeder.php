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
        $user = \App\User::create([
            'name' => '用户',
            'email' =>'admin',
            'password' => bcrypt('123456')
        ]);
        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('admin');
    }
}
