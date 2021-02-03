<?php

use Illuminate\Database\Seeder;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('information')->insert([
            'information' => '新型コロナウイルス 各国の入国制限に関する一覧（2021年2月3日09:00時点)',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
        ]);
    }
}
