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

Route::get('/', 'UserController@home');
Route::get('/book/{book}', 'UserController@bookdetail');

// *** Auth *** ///
Route::middleware(['NonAuthenticated'])->group(function () {
    Route::get('/auth/login', 'AuthsController@login');
    Route::get('/auth/register', 'AuthsController@register');
    Route::post('/auth/login', 'AuthsController@loginpost');
    Route::post('/auth/register', 'AuthsController@registerpost');
    Route::get('/verify', 'AuthsController@verify');
});

Route::middleware(['Authenticated'])->group(function () {
    Route::get('/admin/books', 'AdminController@bookall');
    Route::get('/admin/books/download/{id}', 'AdminController@download')->withoutMiddleware('Authenticated');

    Route::get('/admin/books/create', 'AdminController@bookcreateview');
    Route::post('/admin/books/create', 'AdminController@bookcreate');


    Route::get('/admin/genre', 'AdminController@genreview');
    Route::get('/admin/genres/create', 'AdminController@genrecreateview');
    Route::post('/admin/genres/create', 'AdminController@genrecreate');

    Route::get('/admin/books/{books}', 'AdminController@bookdetailview');
    Route::patch('/admin/books/{books}', 'AdminController@bookupdate');
    Route::delete('/admin/books/{books}', 'AdminController@bookdelete');
});


