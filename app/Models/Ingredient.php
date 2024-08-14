<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'foodId',
        'name',
    ];

    public function food(): BelongsTo {
        return $this->belongsTo(Food::class, 'foodId');
    }
}
