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
    return view('books.home');
});


Route::get('/admin/books', 'AdminController@bookall');
Route::get('/admin/books/download', 'AdminController@download');


Route::get('/admin/books/create', 'AdminController@bookcreateview');
Route::post('/admin/books/create', 'AdminController@bookcreate');


Route::get('/admin/books/{books}', 'AdminController@bookdetailview');
Route::patch('/admin/books/{books}', 'AdminController@bookupdate');
Route::delete('/admin/books/{books}', 'AdminController@bookdelete');
