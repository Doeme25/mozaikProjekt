<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::get('/', function () {
    $books = Book::all();
    return view('FrontPage', ['books' => $books]);
});

Route::get('/books/{id}', function ($id) {
    return view('BookDetails', ['id' => $id]);
});
