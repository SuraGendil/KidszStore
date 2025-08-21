<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'category_id',
        'title',
        'image',
        'stock',
        'sold_count',
        'price',
        'status',
    ];

    /**
     * Kolom tambahan yang akan muncul saat model diubah ke array/JSON.
     *
     * @var array<int, string>
     */
    protected $appends = ['image_url'];

    /**
     * Mengambil URL lengkap untuk gambar produk.
     *
     * @return string|null
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? Storage::url($this->image) : null;
    }


    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
