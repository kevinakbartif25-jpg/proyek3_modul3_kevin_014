<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $seminar  = Category::where('slug', 'seminar')->firstOrFail();
        $workshop = Category::where('slug', 'workshop')->firstOrFail();

        for ($i = 1; $i <= 18; $i++) {
            $isSeminar = $i % 2 === 1;

            Activity::updateOrCreate(
                ['code' => sprintf('ACT-%03d', $i)],
                [
                    'category_id'   => $isSeminar ? $seminar->id : $workshop->id,
                    'title'         => ($isSeminar ? 'Seminar' : 'Workshop') . " Kegiatan {$i}",
                    'description'   => "Deskripsi untuk kegiatan nomor {$i}.",
                    'activity_date' => now()->addDays($i * 3)->toDateString(),
                    'status'        => $i % 3 === 0 ? 'Done' : 'Planned',
                ]
            );
        }
    }
}