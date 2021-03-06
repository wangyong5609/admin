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
                'type' => \App\Enums\DictTypes::STAFF_STATUS,
                'items' => [
                    '上班' => \App\Enums\DictCodes::STAFF_STATUS_WORk,
                    '出差' => \App\Enums\DictCodes::STAFF_STATUS_BUSINESS,
                    '请假' => 'leave',
                ],
            ],
            [
                'type' => \App\Enums\DictTypes::MISSION_STATUS,
                'items' => [
                    '尚未安排' => 'new',
                    '正在进行' => 'doing',
                    '排队等待' => 'wait',
                    '已经完成' => 'complete',
                    '关闭' => 'close',
                ],
            ],
            [
                'type' => \App\Enums\DictTypes::STAFF_MISSION_STATUS,
                'items' => [
                    '无任务' => 'no_mission',
                    '任务中' => 'missioning',
                ],
            ],
            [
                'type' => \App\Enums\DictTypes::MISSION_PRIORITY,
                'items' => [
                    '普通' => 'common',
                    '优先' => 'importance',
                    '紧急' => 'urgency',
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
