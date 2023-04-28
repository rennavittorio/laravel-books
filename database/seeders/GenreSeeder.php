<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genre_names = ['romanzo', 'sci-fi', 'hentai'];

        foreach ($genre_names as $genre_name) {
            $new_g = new Genre();

            $new_g->name = $genre_name;

            $new_g->save();
        }
    }
}
