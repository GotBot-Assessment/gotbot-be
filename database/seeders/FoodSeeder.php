<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $response = Http::get('https://www.themealdb.com/api/json/v1/1/search.php?s=');

        if ($response->ok()) {
            collect($response->json('meals'))->each(function ($food) {
                $foodRecord = Food::factory()->create([
                    'name'        => $food['strMeal'],
                    'description' => $food['strInstructions'],
                    'category'    => $food['strCategory'],
                    'area'        => $food['strArea'],
                ]);

                $ingredients = collect($food)->keys()
                    ->filter(fn($key) => Str::of($key)->startsWith('strIngredient'))
                    ->filter(fn($key) => !!$food[$key])
                    ->map(fn($key) => [
                        'name'       => $food[$key],
                        'created_at' => now(),
                        'updated_at' => now(),
                        'foodId'     => $foodRecord->id
                    ])->toArray();

                DB::table('ingredients')->insert($ingredients);
            });
        }
    }
}
