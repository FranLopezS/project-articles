<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Article;
use App\Models\Category;

class ArticleController extends Controller
{
    public function list()
    {
        $articles = Article::all();
        return view('index')->with('articles', $articles);
    }

    public function list_novedades()
    {
        $articles = Article::all();
        return view('novedades')->with('articles', $articles);
    }

    public function show(Request $request, $category_slug, $article_slug)
    {
        $article = Article::where('slug', $article_slug)->first();
        return view('article')->with('article', $article);
    }

    public function create(Request $request) // Pasar usuario y categoría
    {
        $title = $request->title;
        $slug = Str::slug($title, '-');
        $content = $request->content;
        $category_id = $request->categories;

        $category = Category::find($category_id);

        if($newArticle = Article::create(['title' => $title, 'slug' => $slug, 'content' => $content])) {
            $newArticle->category()->associate($category);
            $newArticle->save();
            return response()->json(['0']); // Ok
        }
        
        return response()->json(['1']); // Error
    }

    public function update(Request $request)
    {
        $title = $request->title;
        $slug = Str::slug($title, '-');
        $content = $request->content;

        if(Article::where('article_id', $request->id)->update(['title' => $title, 'slug' => $slug, 'content' => $content])) {
            return response()->json(['0']); // Ok
        }
        
        return response()->json(['1']); // Error
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $article = Article::find($id);
        if($article->delete()) return response()->json(['0']); // Ok
        
        return response()->json(['1']); // Error
    }
}
