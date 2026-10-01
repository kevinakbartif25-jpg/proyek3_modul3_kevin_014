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

            $status = ['draft', 'published', 'completed'][$i % 3];
            $isComplete = ! ($status === 'draft' && $i % 2 === 0);

            // Kegiatan completed ada di masa lalu, sisanya di masa depan
            $day = $status === 'completed'
                ? now()->subDays($i * 3)
                : now()->addDays($i * 3);

            $activity = Activity::firstOrNew(['code' => sprintf('ACT-%03d', $i)]);

            $activity->fill([
                'category_id' => $isSeminar ? $seminar->id : $workshop->id,
                'title'       => ($isSeminar ? 'Seminar' : 'Workshop') . " Kegiatan {$i}",
                'description' => "Deskripsi untuk kegiatan nomor {$i}.",
                'location'    => $isComplete ? "Ruang {$i}" : null,
                'start_at'    => $day->copy()->setTime(9, 0),
                'end_at'      => $day->copy()->setTime(12, 0),
                'capacity'    => $isComplete ? 50 : null,
            ]);

            // status tidak ada di $fillable, jadi harus diisi dengan forceFill
            $activity->forceFill(['status' => $status])->save();
        }
    }
}