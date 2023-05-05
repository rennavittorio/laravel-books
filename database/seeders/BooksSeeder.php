<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class BooksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $genre_ids = Genre::all()->pluck('id')->all();
        $author_ids = Author::all()->pluck('id')->all();

        for ($i = 0; $i < 100; $i++) {

            $book = new Book();

            $book->isbn_code = $faker->bothify('###-##-#####-##-#');
            $book->title = $faker->sentence(5);
            $book->slug = Str::slug($book->title, '-');
            $book->pages = $faker->randomNumber(3, true);
            $book->isAvailable = $faker->boolean();
            $book->copies = $faker->randomNumber(2, true);
            $book->genre_id = $faker->randomElement($genre_ids);

            $book->save();

            $book->authors()->attach($faker->randomElements($author_ids, rand(1, 3)));
        }
    }
}
