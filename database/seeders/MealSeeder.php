<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/search.php?s=');

        if ($response->ok()) {
            collect($response->json('meals'))->each(function ($meal) {
                $mealRecord = Meal::factory()->create([
                    'name'        => $meal['strMeal'],
                    'description' => $meal['strInstructions'],
                    'category'    => $meal['strCategory'],
                    'area'        => $meal['strArea'],
                ]);

                $ingredients = collect($meal)->keys()
                    ->filter(fn($key) => Str::of($key)->startsWith('strIngredient'))
                    ->filter(fn($key) => !!$meal[$key])
                    ->map(fn($key) => [
                        'name'       => $meal[$key],
                        'created_at' => now(),
                        'updated_at' => now(),
                        'mealId'     => $mealRecord->id
                    ])->toArray();

                DB::table('ingredients')->insert($ingredients);

                //attach image to meal record.
                $mealRecord->addMediaFromUrl($meal['strMealThumb'])->toMediaCollection('meal');
            });
        }
    }
}
