<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create an admin account
        $admin = User::factory()
            ->has(Tag::factory()->count(4))
            ->has(Author::factory()->count(4))
            ->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'role' => 2
            ]);

        $tag_ids = Tag::get()->pluck('id');

        $authors = Author::get();

        $authors->each(function ($author) use ($admin) {
            Book::factory()
                ->count(2)
                ->create(['author_id' => $author->id, 'user_id' => $admin->id]);
        });

        $books = Book::get();


        $books->each(function ($book) use ($tag_ids) {
            $book->tags()->attach($tag_ids->random(2));
        });

        // create readers or normal users
        $readers = User::factory()
            ->count(3)
            ->create();

        $book_ids = Book::get()->pluck('id');

        $readers->each(function ($reader) use($book_ids) {
            $reader->favBooks()->attach($book_ids->random(2));
        });
    }
}
