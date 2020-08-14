<?php

use Illuminate\Database\Seeder;

class BannerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Banner::insert([
            [
                'kata1' => 'belajar bersama kami di bimble',
                'kata2' => 'bimble adalah sebuah kursus belajar terbaik',
                'gambar_banner' => 'gambar1.jpg'
            ],
            [
                'kata1' => 'belajar bersama kami di bimble',
                'kata2' => 'bimble adalah sebuah kursus belajar terbaik',
                'gambar_banner' => 'gambar2.jpg'
            ],
            [
                'kata1' => 'belajar bersama kami di bimble',
                'kata2' => 'bimble adalah sebuah kursus belajar terbaik',
                'gambar_banner' => 'gambar3.jpg'
            ]
        ]);
    }
}
