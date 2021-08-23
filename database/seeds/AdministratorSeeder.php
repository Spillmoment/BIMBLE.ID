<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new \App\Manager;
        $manager->nama = "Uchiha Madara";
        $manager->username = "Madara17";
        $manager->email = "test@gmail.com";
        $manager->jenis_kelamin = "l";
        $manager->alamat = "lumajang";
        $manager->password = Hash::make("123");
        $manager->save();
        $this->command->info("User Admin berhasil diinsert");
    }
}
