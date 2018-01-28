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
                    '尚未安排' => 'new',
                    '正在进行' => 'doing',
                    '排除等待' => 'wait',
                    '已经完成' => 'complete',
                ],
            ],
            [
                'type' => \App\Enums\DictTypes::MISSION_ARITHMETIC,
                'items' => [
                    '单个' => 'simple',
                    '批量' => 'batch',
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
