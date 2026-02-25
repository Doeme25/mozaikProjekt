<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Translation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $books = Book::factory(50)->create();

        foreach ($books as $book) {
            Translation::create([
                'book_id' => $book->id,
                'language' => 'en',
                'title' => $book->title,
                'description' => $book->description,
            ]);

            Translation::create([
                'book_id' => $book->id,
                'language' => 'hu',
                'title' => fake()->sentence(3),
                'description' => fake()->paragraph(),
            ]);
        }
    }
}
