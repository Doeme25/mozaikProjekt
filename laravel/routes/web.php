<?php

use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::get('/', function () {
    $query = Book::query();

    if (request('search')) {
        $search = request('search');
        $query->where('title', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%");
    }

    match (request('sort')) {
        'title_asc'  => $query->orderBy('title', 'asc'),
        'title_desc' => $query->orderBy('title', 'desc'),
        'year_asc'   => $query->orderBy('published_year', 'asc'),
        'year_desc'  => $query->orderBy('published_year', 'desc'),
        'sold_desc'  => $query->orderBy('units_sold', 'desc'),
        'stock_desc' => $query->orderBy('remaining_stock', 'desc'),
        'stock_asc'  => $query->orderBy('remaining_stock', 'asc'),
        default      => $query->orderBy('title', 'asc'),
    };

    $books = $query->get();
    return view('FrontPage', ['books' => $books]);
});

Route::get('/books/{id}', function ($id) {
    return view('BookDetails', ['id' => $id]);
});
