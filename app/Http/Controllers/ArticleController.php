<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function list()
    {
        $articles = array();
        $categoriesQuery = Article::all();
        foreach ($categoriesQuery as $article) {
            $articles[$article->id_article] = $article;
            $categories = array();
            $categoriesQuery = Category::join('articles_categories', 'categories.id_category', '=', 'articles_categories.id_category')
                ->where('articles_categories.id_article', $article->id_article)
                ->get();
            foreach ($categoriesQuery as $category) {
                $categories[$category->id_category] = $category;
            }
            $articles[$article->id_article]['categories'] = $categories;
        }
        return view('index')->with('articles', $articles);
    }

    public function list_novedades()
    {
        $articles = Article::select('articles.title', 'articles.content', 'categories.name')
            ->join('articles_categories', 'articles.id_article', '=', 'articles_categories.id_article')
            ->join('categories', 'articles_categories.id_category', '=', 'categories.id_category')
            ->where('categories.slug', 'novedades')
            ->get();
        return view('novedades')->with('articles', $articles);
    }
}
