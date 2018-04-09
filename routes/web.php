<?php

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
use App\Book;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    //Route::get('companies', 'CompaniesController@index')->name('companies.index');
    Route::get('books', 'BooksController@index')->name('books.index');
    Route::get('purchase-chapters', 'ChaptersController@purchaseChapters')->name('purchase-chapters.index');
});

Route::get('/read_chapter', function(){
	$book = Book::find(1);
	dd($book->chapters()->get());
});
