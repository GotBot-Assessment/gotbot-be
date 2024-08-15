<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Ingredient;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory(10)->create();

        /*    Food::factory(50)->create()
                ->each(function ($food) {
                    $food->ingredients()->saveMany(
                        Ingredient::factory(rand(1, 5))->make()
                    );
              });

            /*        User::factory()->create([
                        'name' => 'Test User',
                        'email' => 'test@example.com',
                    ]);*/
    }
}
