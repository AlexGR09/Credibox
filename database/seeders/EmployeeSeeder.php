<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('employees')->insert([
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 6,
                'company_id' => 1,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 7,
                'company_id' => 1,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 8,
                'company_id' => 1,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 9,
                'company_id' => 2,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 10,
                'company_id' => 2,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 11,
                'company_id' => 2,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 12,
                'company_id' => 3,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 13,
                'company_id' => 3,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 14,
                'company_id' => 3,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 15,
                'company_id' => 4,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 16,
                'company_id' => 4,
            ],
            [
                'name' => $faker->firstName,
                'lastname' => $faker->lastName,
                'genero' => $faker->randomElement(['F','M']),
                'phone' => $faker->e164PhoneNumber,
                'user_id' => 17,
                'company_id' => 4,
            ],
        ]);
    }
}
