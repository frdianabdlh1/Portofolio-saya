<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'thumbnail',
        'live_url', 'github_url', 'tech_stack',
        'year', 'order', 'is_featured', 'is_published',
    ];

    protected $casts = [
        'tech_stack'   => 'array',
        'is_featured'  => 'boolean',
        'is_published' => 'boolean',
        'year'         => 'integer',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderByDesc('year');
    }

    public function getThumbnailUrlAttribute(): string
    {
        return $this->thumbnail
            ? asset('storage/' . $this->thumbnail)
            : asset('images/default-project.jpg');
    }
}