<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // 'status' sengaja tidak ada di sini: perubahan status hanya lewat ActivityService
    protected $fillable = [
        'category_id', 'code', 'title', 'description',
        'location', 'start_at', 'end_at', 'capacity',
    ];

    protected function casts(): array
    {
        return [
            'start_at' => 'datetime',
            'end_at' => 'datetime',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function scopeSearch($query, ?string $keyword)
    {
        return $query->when($keyword, function ($query, $keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")
                      ->orWhere('code', 'like', "%{$keyword}%");
            });
        });
    }

    public function scopeInCategory($query, $categoryId)
    {
        return $query->when($categoryId, fn ($query, $id) => $query->where('category_id', $id));
    }

    public function scopeOfStatus($query, ?string $status)
    {
        return $query->when(
            in_array($status, ['draft', 'published', 'completed'], true),
            fn ($query) => $query->where('status', $status)
        );
    }

    public function scopeSortByStart($query, ?string $direction)
    {
        return $query->orderBy('start_at', $direction === 'oldest' ? 'asc' : 'desc');
    }
}