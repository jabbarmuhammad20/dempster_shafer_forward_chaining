<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penyakits = [
            [
                'kode' => 'P001',
                'nama_penyakit' => 'Homoseksual',
            ],
            [
                'kode' => 'P002',
                'nama_penyakit' => 'Biseksual',
            ],
            [
                'kode' => 'P003',
                'nama_penyakit' => 'Heteroseksual',
            ],
           
        ];

        foreach ($penyakits as $penyakit) {
            Penyakit::create($penyakit);
        }
    }
}
