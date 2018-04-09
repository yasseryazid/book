<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
   // Route::resource('companies', 'CompaniesController', ['except' => ['create', 'edit']]);
    Route::resource('books', 'BooksController', ['except' => ['create', 'edit']]);
    Route::post('books/store', 'BooksController@store');
    Route::resource('chapters', 'ChaptersController', ['except' => ['create', 'edit']]);
    Route::post('chapters/store', 'ChaptersController@store');
	Route::get('purchase', 'ChaptersController@purchaseChapters');
	Route::get('purchase-by-book/{id}', 'ChaptersController@purchaseChapterByBook');
});
