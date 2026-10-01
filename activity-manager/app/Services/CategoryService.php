<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Validation\ValidationException;

class ActivityService
{
    // Field wajib sebelum publish (BR-05)
    private const REQUIRED_FIELDS = [
        'category_id' => 'kategori',
        'code'        => 'kode',
        'title'       => 'judul',
        'location'    => 'lokasi',
        'start_at'    => 'tanggal mulai',
        'end_at'      => 'tanggal selesai',
        'capacity'    => 'kapasitas',
    ];

    public function publish(Activity $activity): Activity
    {
        if ($activity->status !== 'draft') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan draft yang dapat dipublikasikan.',
            ]);
        }

        $missing = [];
        foreach (self::REQUIRED_FIELDS as $field => $label) {
            if (blank($activity->{$field})) {
                $missing[] = $label;
            }
        }

        if ($missing) {
            throw ValidationException::withMessages([
                'status' => 'Kegiatan belum dapat dipublikasikan. Data belum lengkap: ' . implode(', ', $missing) . '.',
            ]);
        }

        if ($activity->end_at->lt($activity->start_at)) {
            throw ValidationException::withMessages([
                'status' => 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai.',
            ]);
        }

        if ($activity->capacity < 1 || $activity->capacity > 500) {
            throw ValidationException::withMessages([
                'status' => 'Kapasitas harus antara 1 dan 500.',
            ]);
        }

        $activity->forceFill(['status' => 'published'])->save();

        return $activity;
    }

    public function complete(Activity $activity): Activity
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'status' => 'Hanya kegiatan published yang dapat diselesaikan.',
            ]);
        }

        $activity->forceFill(['status' => 'completed'])->save();

        return $activity;
    }
}