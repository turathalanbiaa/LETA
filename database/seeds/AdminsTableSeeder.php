<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Arabic AdminRepository
        factory(Admin::class)->create([
            'name' => "عماد وهاب الكعبي",
            'lang' => "ar",
            'username' => "emad.ar@gmail.com",
            'password' => md5("12341234"),
            'created_at' => date("Y-m-d"),
            'last_login_date' => null,
            'remember_token' => null
        ]);

        // English AdminRepository
        factory(Admin::class)->create([
            'name' => "Emad Al-Kabi",
            'lang' => "en",
            'username' => "emad.en@gmail.com",
            'password' => md5("12341234"),
            'created_at' => date("Y-m-d"),
            'last_login_date' => null,
            'remember_token' => null
        ]);
    }
}