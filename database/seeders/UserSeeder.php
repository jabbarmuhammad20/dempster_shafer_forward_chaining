<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pasien;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'type' => 1,
                'password' => Hash::make('password123'),
            ],
        ];

        for ($i = 1; $i <= 10; $i++) {
            $users[] = [
                'name' => "Regular User $i",
                'email' => "user$i@example.com",
                'type' => 0,
                'password' => Hash::make('password123'),
            ];
        }

        foreach ($users as $userData) {
            $user = User::create($userData);

            if ($user->type == 'user') {
                Pasien::create([
                    'user_id' => $user->id,
                    'ktp' => '123456789' . $user->id,
                    'tgl_lahir' => '1990-01-01',
                    'tempat_lahir' => 'City',
                    'alamat' => 'Address',
                    'diagnosis' => null,
                    'confidence' => null,
                ]);
            }
        }
    }
}
