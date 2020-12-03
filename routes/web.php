<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NewsportalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AjaxpageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);    
    Route::resource('posts', PostController::class);
    Route::resource('newsportal', NewsportalController::class);

    Route::post('addposts', [App\Http\Controllers\PostController::class, 'store']);
    Route::post('editposts', [App\Http\Controllers\PostController::class, 'update']);
    Route::get('editposts/{id}', [App\Http\Controllers\PostController::class, 'edit']);
    Route::put('updateposts/{id}', [App\Http\Controllers\PostController::class, 'update']);

    Route::resource('category', CategoryController::class);
    Route::post('addcategory', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::post('editcategory', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::get('editcategory/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
    Route::put('updatecategory/{id}', [App\Http\Controllers\CategoryController::class, 'update']);

    Route::resource('author', AuthorController::class);
    Route::post('addauthor', [App\Http\Controllers\AuthorController::class, 'store']);
    Route::post('editauthor', [App\Http\Controllers\AuthorController::class, 'update']);
    Route::get('editauthor/{id}', [App\Http\Controllers\AuthorController::class, 'edit']);
    Route::put('updateauthor/{id}', [App\Http\Controllers\AuthorController::class, 'update']);

    Route::resource('pages', PageController::class);
    Route::resource('page', PageController::class);      
    Route::post('addpage', [App\Http\Controllers\PageController::class, 'store'])->name('add.page');
    Route::POST('/pages/getData',[App\Http\Controllers\PageController::class, 'getData']);
    Route::get('pages/{id}', [App\Http\Controllers\PageController::class, 'edit'])->name('edit.page');

    Route::PUT('updatepage/{id}', [App\Http\Controllers\PageController::class, 'update']);

    

    // Route::get('editpage/{id}', [App\Http\Controllers\PageController::class, 'getDatabyID']);
    
    
   

   
    

});