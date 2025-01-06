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
                'deskripsi' => 'Saya seorang non-biner (menganggap dirinya termasuk, tidak termasuk atau bahkan gabungan dari laki-laki dan perempuan)',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G002',
                'deskripsi' => 'Sering menonton drama/film BoysLove maupun GirlsLove',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.7,
            ],
            [
                'kode' => 'G003',
                'deskripsi' => 'Sering membaca novel/komik BoysLove maupun GirlsLove',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.6,
            ],
            [
                'kode' => 'G004',
                'deskripsi' => 'Memiliki rasa ingin tahu tentang dunia LGBTQ+',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.9,
            ],
            [
                'kode' => 'G005',
                'deskripsi' => 'Bergaul dengan teman yang memang gay maupun lesbian',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.85,
            ],
            [
                'kode' => 'G006',
                'deskripsi' => 'Merasa berdebar ketika disentuh oleh sesama jenis',
                'penyakit_id' => 1, // Homoseksual
                'blf' => 0.75,
            ],
            [
                'kode' => 'G007',
                'deskripsi' => 'Merasa berdebar ketika disentuh oleh sesama jenis',
                'penyakit_id' => 1, // Homoseksual
                'blf' => 0.65,
            ],
            [
                'kode' => 'G008',
                'deskripsi' => 'Merasa berdebar ketika disentuh oleh sesama jenis',
                'penyakit_id' => 1, // Homoseksual
                'blf' => 0.7,
            ],
            [
                'kode' => 'G009',
                'deskripsi' => 'Memiliki trauma terhadap lawan jenis',
                'penyakit_id' => 1, // Homoseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G010',
                'deskripsi' => 'Merasa berdebar ketika disentuh oleh lawan dan sesama jenis',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G011',
                'deskripsi' => 'Tertarik untuk melakukan kontak fisik dengan lawan dan sesama jenis (seperti berpelukan atau mencium)',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G012',
                'deskripsi' => 'Pernah membayangkan fantasi terhadap lawan dan sesama jenis',
                'penyakit_id' => 2, // Biseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G013',
                'deskripsi' => 'Merasa berdebar ketika disentuh oleh lawan jenis',
                'penyakit_id' => 3, // Heteroseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G014',
                'deskripsi' => 'Lebih tertarik untuk melakukan kontak fisik dengan lawan jenis (seperti berpelukan atau mencium)',
                'penyakit_id' => 3, // Heteroseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G015',
                'deskripsi' => 'Pernah membayangkan fantasi terhadap lawan jenis',
                'penyakit_id' => 3, // Heteroseksual
                'blf' => 0.8,
            ],
            [
                'kode' => 'G016',
                'deskripsi' => 'Pernah membayangkan fantasi terhadap lawan jenis',
                'penyakit_id' => 3, // Heteroseksual
                'blf' => 0.8,
            ],
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
