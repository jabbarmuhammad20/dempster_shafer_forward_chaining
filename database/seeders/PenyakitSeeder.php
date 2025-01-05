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
                'nama_penyakit' => 'Gonore',
            ],
            [
                'kode' => 'P002',
                'nama_penyakit' => 'Klamidia',
            ],
            [
                'kode' => 'P003',
                'nama_penyakit' => 'Sifilis',
            ],
            [
                'kode' => 'P004',
                'nama_penyakit' => 'Herpes Genital',
            ],
            [
                'kode' => 'P005',
                'nama_penyakit' => 'HIV/AIDS',
            ],
            [
                'kode' => 'P006',
                'nama_penyakit' => 'Trikomoniasis',
            ],
            [
                'kode' => 'P007',
                'nama_penyakit' => 'Hepatitis B',
            ],
            [
                'kode' => 'P008',
                'nama_penyakit' => 'Human Papillomavirus (HPV)',
            ],
        ];

        foreach ($penyakits as $penyakit) {
            Penyakit::create($penyakit);
        }
    }
}
