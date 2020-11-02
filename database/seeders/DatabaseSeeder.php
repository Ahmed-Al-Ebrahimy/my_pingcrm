<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Patient;
use App\Models\Address;
use App\Models\Type;
use App\Models\Occupation;
use App\Models\Educationlevel;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


            // \App\Models\User::factory(10)->create();





        // Patient::factory(100)->create();
    public function run()
    {
        User::factory()->create([
            'name'              => 'Ahmed Al-Ebrahimy',
            'email'             => 'alebrahimyahmed@gmail.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);


        User::factory()->create([
            'name'              => 'Ali Al-Ebrahimy',
            'email'             => 'alebrahimyali@gmail.com',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        Address::factory(100)->create();
        Educationlevel::factory(100)->create();
        Occupation::factory(100)->create();
        Type::factory(100)->create();

    }
}
