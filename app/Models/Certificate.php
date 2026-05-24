<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'issuer', 'year', 'emoji', 'image', 'credential_url'
    ];


    protected $casts = [
        'is_published' => 'boolean',
        'year'         => 'integer',
    ];

    // WAJIB ADA INI:
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order')->orderByDesc('year');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}