<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category',
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
}
