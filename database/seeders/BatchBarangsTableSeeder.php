<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BatchBarang;

class BatchBarangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BatchBarang::truncate();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            BatchBarang::create([
                'id_barang' => $faker->numberBetween(1, 10),
                'kode_batch' => $faker->word,
                'kuantitas' => $faker->numberBetween(0, 100),
                'tanggal_produksi' => $faker->date,
                'tanggal_kadaluarsa' => $faker->date,
            ]);
        }
    }
}
