<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::query()->insert([
            [
                'title' => 'Workshop Git Dasar',
                'description' => 'Latihan kolaborasi repository.',
                'activity_date' => '2026-10-05',
                'category' => 'Workshop',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Seminar Web Quality',
                'description' => 'Pengenalan maintainability dan testing.',
                'activity_date' => '2026-10-12',
                'category' => 'Seminar',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pengembangan Text Editor C',
                'description' => 'Implementasi buffer dan fungsi editing modular.',
                'activity_date' => '2026-10-15',
                'category' => 'Proyek',
                'status' => 'Ongoing',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kalkulasi Damage Genshin',
                'description' => 'Optimalisasi build dan perhitungan damage karakter.',
                'activity_date' => '2026-10-18',
                'category' => 'Gaming',
                'status' => 'Done',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Belajar Matematika Diskrit',
                'description' => 'Latihan soal logika ekuivalensi dan teori himpunan.',
                'activity_date' => '2026-10-20',
                'category' => 'Akademik',
                'status' => 'Planned',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}