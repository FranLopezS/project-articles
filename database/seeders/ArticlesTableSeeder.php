<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::truncate();

        $categoriesIds = array();
        $users = array();
        $categoriesData = Category::all();
        $usersData = User::all();
        foreach ($categoriesData as $category) $categoriesIds[] = $category->id_category;
        foreach ($usersData as $user) $users[] = $user;
        
        $faker = Faker::create('es_ES');
        for ($i=0; $i < 100; $i++) {
            shuffle($users);

            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $slug = Str::slug($title, '-');
            $newArticle = Article::create([
                'title' => $title,
                'content' =>  $faker->sentence($nbWords = 300, $variableNbWords = true),
                'slug' => $slug
            ]);
            $newArticle->user()->associate($users[0]);
            
            shuffle($categoriesIds);
            $categoriesToAdd = rand(1, count($categoriesIds));
            for ($p=0; $p < $categoriesToAdd; $p++) { // Se asigna una o más categorías al artículo.
                $newArticle->categories()->attach($categoriesIds[$p]);
            }
        }
    }
}
