<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gejala;

class GejalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gejalas = [
            [
                'kode' => 'G001',
                'deskripsi' => 'Nyeri saat buang air kecil',
                'penyakit_id' => 1, // Gonore
                'blf' => 0.8,
            ],
            [
                'kode' => 'G002',
                'deskripsi' => 'Keluarnya cairan tidak normal dari alat kelamin',
                'penyakit_id' => 1, // Gonore
                'blf' => 0.7,
            ],
            [
                'kode' => 'G003',
                'deskripsi' => 'Nyeri perut bagian bawah',
                'penyakit_id' => 2, // Klamidia
                'blf' => 0.6,
            ],
            [
                'kode' => 'G004',
                'deskripsi' => 'Luka pada alat kelamin',
                'penyakit_id' => 3, // Sifilis
                'blf' => 0.9,
            ],
            [
                'kode' => 'G005',
                'deskripsi' => 'Luka atau lepuhan pada alat kelamin',
                'penyakit_id' => 4, // Herpes Genital
                'blf' => 0.85,
            ],
            [
                'kode' => 'G006',
                'deskripsi' => 'Demam dan pembengkakan kelenjar getah bening',
                'penyakit_id' => 5, // HIV/AIDS
                'blf' => 0.75,
            ],
            [
                'kode' => 'G007',
                'deskripsi' => 'Gatal atau iritasi pada alat kelamin',
                'penyakit_id' => 6, // Trikomoniasis
                'blf' => 0.65,
            ],
            [
                'kode' => 'G008',
                'deskripsi' => 'Kuning pada kulit dan mata (jaundice)',
                'penyakit_id' => 7, // Hepatitis B
                'blf' => 0.7,
            ],
            [
                'kode' => 'G009',
                'deskripsi' => 'Kutil pada alat kelamin',
                'penyakit_id' => 8, // Human Papillomavirus (HPV)
                'blf' => 0.8,
            ],
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
