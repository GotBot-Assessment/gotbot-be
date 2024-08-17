<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        User::factory(1, [
            'name' => 'Test Chef',
            'email' => 'gotbot@chef.com',
            'password' => 'P@55word!@#'
        ])->create();

        $this->call(MealSeeder::class);
    }
}
