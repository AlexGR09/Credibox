<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('users')->insert([
            //---------------Admin-------------------------------
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make("Admin"),
            ],
            //-------------- COMPANY---------------------------
            [
                'name' => $Name = $faker->firstName.'Company',
                'email' => 'info@'.$Name.'.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'Company',
                'email' => 'info@'.$Name.'.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'Company',
                'email' => 'info@'.$Name.'.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'Company',
                'email' => 'info@'.$Name.'.com',
                'password' => Hash::make("root1234"),
            ],
            //-------------- EMPLOYEES---------------------------
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
            [
                'name' => $Name = $faker->firstName.'User',
                'email' => $Name.'@gmail.com',
                'password' => Hash::make("root1234"),
            ],
        ]);   
    }
}
