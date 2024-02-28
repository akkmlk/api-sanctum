<?php

namespace Database\Seeders;

use App\Models\Obat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $obats = [
            [
                'name' => "Paracetamol",
                'price' => 15000,
                'kategori' => 'tablet',
            ],
            [
                'name' => "OBH",
                'price' => 13000,
                'kategori' => 'cair',
            ],
        ];

        foreach ($obats as $key => $value) {
            Obat::create($value);
        }
    }
}
