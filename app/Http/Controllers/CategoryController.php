<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;

use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function list()
    {
        $categories = Category::all();
        return response()->json([$categories]);
    }

    public function create(Request $request)
    {
        $name = $request->name;
        $slug = Str::slug($name, '-');

        try {
            if(Category::create(['name' => $name, 'slug' => $slug])) {
                return response()->json(['ok']); // Ok
            }
        } catch(QueryException $e) {
            return response()->json(['¡Ya existe esa categoría!']);
        }
        
        return response()->json(['¡Error al crear la categoría!']); // Error
    }

    public function update(Request $request)
    {
        $name = $request->name;
        $slug = Str::slug($name, '-');
        $id = $request->id;

        $category = Category::where('category_id', $id)->first();
        $oldName = $category->name;
        $oldSlug = $category->slug;
        if($oldSlug == 'novedades') return response()->json(['¡No se puede borrar esta categoría!']);

        try {
            if($category->update(['name' => $name, 'slug' => $slug])) {
                return response()->json(
                    [
                        'message' => '¡Categoría editada correctamente!', 
                        'updated' => ['old' => ['slug' => $oldSlug, 'name' => $oldName], 'new' => ['slug' => $slug, 'name' => $name]]
                    ]
                ); // Ok
            }
        } catch (QueryException $e) {
            return response()->json(['¡Ya existe esa categoría!']);
        }
        
        return response()->json(['¡Error al editar la categoría!']); // Error
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        
        $category = Category::where('category_id', $id)->first();

        if($category->slug == 'novedades') return response()->json(['¡No se puede borrar esta categoría!']);
        
        try {
            if($category->delete()) return response()->json(['ok']); // Ok
        } catch (QueryException $e) {
            return response()->json(['¡No se puede borrar! ¡Existen artículos que contienen esta categoría!']);
        }
        
        return response()->json(['¡Error al borrar la categoría!']); // Error
    }
}
