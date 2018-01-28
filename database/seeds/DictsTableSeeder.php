<?php

use Illuminate\Database\Seeder;
use App\Enums\CodeTypes;

class DictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dicts = [
            [
                'type' => \App\Enums\DictTypes::STAFF_POST,
                'items' => [
                    '实验岗' => 'test',
                    '检验岗' => 'checkout',
                    '其他' => 'other',
                ],
            ],
            [
                'type' => \App\Enums\DictTypes::STAFF_STATUS,
                'items' => [
                    '上班' => 'work',
                    '出差' => 'business',
                    '请假' => 'leave',
                ],
            ],
            [
                'type' => \App\Enums\DictTypes::MISSION_STATUS,
                'items' => [
                    '新建' => 'new',
                    '进行中' => 'doing',
                    '已结束' => 'over',
                    '关闭' => 'close',
                ],
            ],
        ];
        foreach ($dicts as $dict) {
            foreach ($dict['items'] as $name => $code) {
                if (!\App\Dict::where('name', $name)->where('code', $code)->exists()) {
                    //$this->command->info('Seed dict: ' . $name);
                    \App\Dict::insert([
                        'name' => $name,
                        'type' => $dict['type'],
                        'code' => $code,
                    ]);
                }
            }
        }
    }
}
