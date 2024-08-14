<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'type',
        'userId',
    ];

    protected $casts = [
        'price' => 'double'
    ];

    public function ingredients(): HasMany {
        return $this->hasMany(Ingredient::class, 'foodId');
    }
}
