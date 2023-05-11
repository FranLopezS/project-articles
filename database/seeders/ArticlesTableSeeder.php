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

        $categories = array();
        $users = array();
        $categoriesData = Category::all();
        $usersData = User::all();
        foreach ($categoriesData as $category) $categories[] = $category;
        foreach ($usersData as $user) $users[] = $user;
        
        $faker = Faker::create('es_ES');
        for ($i=0; $i < 100; $i++) {
            shuffle($users);
            shuffle($categories);

            $title = $faker->sentence($nbWords = 6, $variableNbWords = true);
            $slug = Str::slug($title, '-');
            $newArticle = Article::create([
                'title' => $title,
                'content' =>  $faker->sentence($nbWords = 300, $variableNbWords = true),
                'slug' => $slug
            ]);
            $newArticle->user()->associate($users[0]);
            $newArticle->category()->associate($categories[0]);
            $newArticle->save();
        }
    }
}
