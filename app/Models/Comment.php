<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'body', 'image', 'ip_address', 'is_approved'
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // WAJIB ADA INI:
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}