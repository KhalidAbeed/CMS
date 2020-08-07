<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function (){
    Route::resource('categories','categoriescontroller');
    Route::resource('tags','tagscontroller');
    Route::resource('posts','postscontroller');
    Route::get('trashed','postscontroller@trashed')
        ->name('trashed');
    Route::put('restore/{id}','postscontroller@restore')
        ->name('restored');
});

Route::middleware(['auth','admin'])->group(function (){
    Route::get('users','usercontroller@index')->name('users.index');
    Route::post('admins/{user}','usercontroller@make')->name('admins');
    Route::get('user/profile','usercontroller@edit')
        ->name('editprofile');
    Route::put('user/profile','usercontroller@update')
        ->name('updateprofile');

});



