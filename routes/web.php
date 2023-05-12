<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\Authenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index', ['name' => 'James']);
// });

Route::get('/', [ArticleController::class, 'list'])->name('index');
Route::get('/novedades', [ArticleController::class, 'list_novedades'])->name('novedades');
Route::get('/{category_slug}/{article_slug}', [ArticleController::class, 'show'])->name('article');
Route::post('/login', [UserController::class, 'login'])->name('login');


Route::middleware([Authenticate::class])->group(function () {
    Route::get('/categories/list/list', [CategoryController::class, 'list'])->name('list_categories');
    Route::post('/categories/create/create', [CategoryController::class, 'create'])->name('create_category');
    Route::post('/categories/{id}/update', [CategoryController::class, 'update'])->name('update_category');
    Route::post('/categories/{id}/delete', [CategoryController::class, 'delete'])->name('delete_category');
    Route::post('/articles/create/create', [ArticleController::class, 'create'])->name('create_article');
    Route::post('/articles/update/update', [ArticleController::class, 'update'])->name('update_article');
    Route::post('/articles/delete/delete', [ArticleController::class, 'delete'])->name('delete_article');
    Route::post('/signout', [UserController::class, 'signout'])->name('signout');
});