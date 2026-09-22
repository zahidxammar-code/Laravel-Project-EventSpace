<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Kategori;
use Illuminate\Database\Seeder;

class AcaraSeeder extends Seeder
{
    public function run(): void
{
    Kategori::factory()->count(5)->create();
    Acara::factory()->count(20)->create();
}
}