<?php

use Illuminate\Database\Seeder;

class MissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Mission::insert([
            'name' => '出差任务','description' => '特殊任务','upper' =>'1','sustain' =>'0','is_template'=>true,
            'is_special' => true
        ]);
    }
}
