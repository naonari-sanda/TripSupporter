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
                'name' => 'サンダナオナリ',
                'email' => 'mkg_sandy@icloud.com',
                'password' => Hash::make('sasasasa'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'アキノブ',
                'email' => 'akinobu@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'ヨシボー',
                'email' => 'yosibo@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => '太一',
                'email' => 'taichi@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'サレン',
                'email' => 'saren@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'カリン',
                'email' => 'karin@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'みちょぱ',
                'email' => 'himiko@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => '美保',
                'email' => 'miho@icloud.com',
                'password' => Hash::make('wqwqwqwq'),
                'remember_token' => Str::random(10),
            ],
        ]);
    }
}
