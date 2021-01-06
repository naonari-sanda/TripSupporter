<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            CountryTableSeeder::class,
            ReviewTableSeeder::class,
            AcountTableSeeder::class,
            LikeTableSeeder::class,
            InformationTableSeeder::class,
        ]);
    }
}
