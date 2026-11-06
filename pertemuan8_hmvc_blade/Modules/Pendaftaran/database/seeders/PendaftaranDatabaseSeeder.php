<?php

namespace Modules\Pendaftaran\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Pendaftaran\Models\Daftar; // Pastikan model di-import

class PendaftaranDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Masukkan data dummy langsung menggunakan factory ke tabel daftars
        Daftar::factory()->count(10)->create();
    }
}