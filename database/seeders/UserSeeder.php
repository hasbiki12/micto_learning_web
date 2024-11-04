<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat 50 akun dummy
        // User::factory()->count(50)->create([
        //     'role' => 'siswa',
        //     'nis' => function () {
        //         return fake()->numerify('#######');
        //     },
        // ]);

        User::factory()->count(50)->create([
            'role' => 'guru',
            'nuptk' => function () {
                return fake()->numerify('#######');
            },
        ]);
    }
}
