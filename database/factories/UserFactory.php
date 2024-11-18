<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('admin123'), // password default
            'role' => 'siswa', // Set default role sebagai siswa
            'nis' => $this->faker->numerify('#######'), // Generate NIS dummy
        ];
    }
    // Tambahkan state khusus jika Anda ingin membuat user dengan role 'guru'
    // public function guru()
    // {
    //     return $this->state([
    //         'role' => 'guru',
    //         'nis' => null, // Jika guru tidak memerlukan NIS
    //     ]);
    // }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
