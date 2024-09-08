<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barang::truncate();
        
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Barang::create([
                'nama_barang' => $faker->word,
                'kode_barang' => $faker->word,
                'category_id' => $faker->numberBetween(1, 10),
                'lokasi_id' => $faker->numberBetween(1, 10),
                'stok' => $faker->numberBetween(0, 100),
                'harga' => $faker->numberBetween(0, 100000),
            ]);
        }
    }
}
