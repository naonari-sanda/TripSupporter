<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'サンダ',
                'email' => 'mkg_sandy@icloud.com',
                'password' => Hash::make('sasasasa'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'アキノブ',
                'email' => 'akinobu@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ヨシボー',
                'email' => 'yosibo@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => '太一',
                'email' => 'taichi@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'サレン',
                'email' => 'saren@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'カリン',
                'email' => 'karin@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'みちょぱ',
                'email' => 'himiko@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => '美保',
                'email' => 'miho@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'ゲスト',
                'email' => 'test@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],

        ]);
    }
}
