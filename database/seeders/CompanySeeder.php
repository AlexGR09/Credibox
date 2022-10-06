<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruta = storage_path("app/public/img/");
        $faker = Faker::create();
        DB::table('companies')->insert([
            [
                'name' => $faker->company,
                'email' => 'company01@gmail.com',
                'logo' => $ruta.'logo01.jpg',
                'website' => $faker->domainName,
            ],
            [
                'name' => $faker->company,
                'email' => 'company02@gmail.com',
                'logo' => $ruta.'logo02.jpg',
                'website' => $faker->domainName,
            ],
            [
                'name' => $faker->company,
                'email' => 'company03@gmail.com',
                'logo' => $ruta.'logo03.jpg',
                'website' => $faker->domainName,
            ],
            [
                'name' => $faker->company,
                'email' => 'company04@gmail.com',
                'logo' => $ruta.'logo04.jpg',
                'website' => $faker->domainName,
            ],
        ]);
    }
}
