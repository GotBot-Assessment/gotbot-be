<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Food extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

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

    public function registerMediaCollections(): void {
        $this->addMediaCollection('food')->singleFile();
    }
}
