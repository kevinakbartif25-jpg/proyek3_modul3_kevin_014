<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class RegistrationService
{
    public function register(Activity $activity, array $data): Registration
    {
        // Pemeriksaan rule dipisah dari penyimpanan (IC-01 s.d. IC-04)
        $this->ensureCanRegister($activity, $data['email']);

        // IC-05 & IC-06: dua operasi database dalam satu transaction
        return DB::transaction(function () use ($activity, $data) {
            $registration = $activity->registrations()->create([
                'participant_name' => $data['participant_name'],
                'email' => $data['email'],
                'registered_at' => now(),
            ]);

            $activity->increment('registered_count');

            return $registration;
        });
    }

    private function ensureCanRegister(Activity $activity, string $email): void
    {
        if ($activity->status !== 'published') {
            throw ValidationException::withMessages([
                'registration' => 'Pendaftaran hanya untuk kegiatan yang sudah dipublikasikan.',
            ]);
        }

        if ($activity->start_at === null || $activity->start_at->isPast()) {
            throw ValidationException::withMessages([
                'registration' => 'Pendaftaran ditutup karena kegiatan sudah dimulai.',
            ]);
        }

        if ($activity->registrations()->where('email', $email)->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Email ini sudah terdaftar pada kegiatan yang sama.',
            ]);
        }

        if ($activity->registered_count >= $activity->capacity) {
            throw ValidationException::withMessages([
                'registration' => 'Kapasitas kegiatan sudah penuh.',
            ]);
        }
    }
}