<?php

namespace App\Http\Controllers;
//use App\Book;

class BooksController extends Controller
{   
    public function index()
    {
       return view('admin.books.index');    
     //   $book = Book::paginate(20);

    	// return response()->json([
    	// 	'model' => $book
    	// ]);
    }

   

}
