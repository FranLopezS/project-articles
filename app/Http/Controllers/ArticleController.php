<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\QueryException;

class ArticleController extends Controller
{
    public function list()
    {
        $articles = Article::paginate(5);
        return view('index')->with('articles', $articles);
    }

    public function list_novedades()
    {
        $articles = Article::whereHas('category', function($q) {
            $q->where('slug', 'novedades');
        })->paginate(5);
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
        $emailUser = $request->session()->get('email');

        $user = User::where('email', $emailUser)->first();
        $category = Category::where('category_id', $category_id)->first();
        // dd($category);
        try {
            if($newArticle = Article::create(['title' => $title, 'slug' => $slug, 'content' => $content])) {
                $newArticle->category()->associate($category);
                $newArticle->user()->associate($user);
                $newArticle->save();
                return response()->json(['¡Artículo creado correctamente!']); // Ok
            }
        } catch (QueryException $e) {
            return response()->json(['¡Ya existe ese artículo!']);
        }
        
        return response()->json(['¡Error al crear el artículo!']); // Error
    }

    public function update(Request $request)
    {
        $article_id = $request->id;
        $title = $request->title;
        $slug = Str::slug($title, '-');
        $content = $request->content;
        $category_id = $request->categories;
        
        $category = Category::find($category_id);
        $article = Article::where('article_id', $article_id)->first();

        try {
            // Si no cambia la categoría ni el título, no habría que recargar.
            if($article->update(['title' => $title, 'slug' => $slug, 'content' => $content])) {
                $article->category()->associate($category);
                $article->save();
            }
        } catch (QueryException $e) {
            try {
                $article->update(['content' => $content]);
            } catch (QueryException $e) {
                //throw $th;
            }
        }
        
        return redirect()->route('article', ['category_slug' => $category->slug, 'article_slug' => $slug]);
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        $article = Article::find($id);
        if($article->delete()) return redirect()->route('index'); // Ok
        
        return redirect()->route('index'); // Error
    }
}
