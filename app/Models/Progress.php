<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Progress extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'progresses';

    protected $fillable = [
        'name',
        'color',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
