<?php

namespace Database\Factories;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AcaraFactory extends Factory
{
    public function definition(): array
    {
        $mulai = fake()->time('H:i');
        $selesai = date('H:i', strtotime($mulai) + 3600 * fake()->numberBetween(1, 4));

        return [
            'kategori_id' => Kategori::inRandomOrder()->first()?->id ?? Kategori::factory(),
            'dibuat_oleh' => User::where('role', 'admin')->first()?->id ?? User::factory(),
            'nama' => fake()->randomElement(['Seminar', 'Workshop', 'Lomba', 'Pelatihan', 'Kompetisi']) . ' ' . fake()->words(2, true),
            'deskripsi' => fake()->paragraph(),
            'tanggal' => fake()->dateTimeBetween('-1 month', '+2 months')->format('Y-m-d'),
            'waktu_mulai' => $mulai,
            'waktu_selesai' => $selesai,
            'lokasi' => fake()->randomElement(['Aula Sekolah', 'Lab Komputer', 'Ruang Serbaguna', 'Lapangan Utama']),
            'kapasitas' => fake()->numberBetween(20, 100),
            'status' => fake()->randomElement(['akan_datang', 'berlangsung', 'selesai']),
        ];
    }
}