<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Category::create([
            'name' => 'Noticias',
            'slug' => 'noticias'
        ]);

        \App\Models\Category::create([
            'name' => 'Novedades',
            'slug' => 'novedades'
        ]);

        \App\Models\Category::create([
            'name' => 'Anuncios',
            'slug' => 'anuncios'
        ]);
    }
}
