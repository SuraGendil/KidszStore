<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'status',
    ];

    protected $appends = ['image_url'];

    /**
     * Get the full URL for the game's image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }

    /**
     * Mendefinisikan relasi bahwa Game ini 'memiliki banyak' Product.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
