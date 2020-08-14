<?php

use Illuminate\Database\Seeder;
use BannerSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BannerTableSeeder::class);
    }
}
