<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mutasi;

class MutasisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mutasi::truncate();
        
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Mutasi::create([
                'id_batch' => $faker->numberBetween(1, 10),
                'id_user' => $faker->numberBetween(1, 10),
                'jenis_mutasi' => $faker->randomElement(['Masuk', 'Keluar']),
                'jumlah' => $faker->numberBetween(0, 100),
            ]);
        }
    }
}
