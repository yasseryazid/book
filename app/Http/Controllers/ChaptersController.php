<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class ChaptersController extends Controller
{
    public function index()
    {
       return view('admin.chapters.index');    

    }

    public function purchaseChapters()
    {
    	return view('admin.purchaseChapters.index');
    }
}
