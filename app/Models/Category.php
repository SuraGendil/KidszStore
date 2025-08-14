<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'game_id',
        'status',
    ];

    /**
     * Mendapatkan game yang dimiliki oleh kategori ini.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Mendefinisikan relasi bahwa Kategori ini 'memiliki banyak' Product.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
