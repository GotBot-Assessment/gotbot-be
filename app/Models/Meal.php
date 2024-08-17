<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Meal extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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
        return $this->hasMany(Ingredient::class, 'mealId');
    }

    public function registerMediaCollections(): void {
        $this->addMediaCollection('meal')->singleFile();
    }
}
