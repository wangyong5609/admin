<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['实验岗','检验岗','分析岗'];
        foreach ($data as $datum){
            \App\Post::insert([
                'name' => $datum
            ]);
        }
    }
}
