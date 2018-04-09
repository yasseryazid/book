<?php

namespace App\Http\Controllers\Api\V1;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;
use Image;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();

        foreach ($books AS &$book) {
            $book->cover = asset('images/'.$book->cover);
        }

        return $books;
    }

    public function show($id)
    {
        return Book::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return $book;
    }

    public function store(Request $request)
    {
        $imageData = $request->get('cover');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('cover'))->save(public_path('images/').$fileName);

        $params = [
            'user_id'   => $request->get('user_id'),
            'title'     => $request->get('title'),
            'synopsis'  => $request->get('synopsis'),
            'cover'     => $fileName
        ];
        $book = Book::create($params);
        return $book;
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        
        if ($book->cover) {
            unlink(public_path('images/'.$book->cover));
        }
        
        $book->delete();
        return '';
    }
}