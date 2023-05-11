<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

        if(Category::create(['name' => $name, 'slug' => $slug])) {
            return response()->json(['0']); // Ok
        }
        
        return response()->json(['1']); // Error
    }

    public function update(Request $request)
    {
        $name = $request->name;
        $slug = Str::slug($name, '-');

        if(Category::where('category_id', $request->id)->update(['name' => $name, 'slug' => $slug])) {
            return response()->json(['0']); // Ok
        }
        
        return response()->json(['1']); // Error
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        
        if($category->delete()) return response()->json(['0']); // Ok
        
        return response()->json(['1']); // Error
    }
}
