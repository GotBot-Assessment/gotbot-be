<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'area',
    ];

    protected $casts = [
        'price' => 'double'
    ];

    public function ingredients(): HasMany {
        return $this->hasMany(Ingredient::class, 'foodId');
    }
}
