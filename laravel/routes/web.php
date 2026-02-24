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
    
    $book = Book::find($id);

    if (!$book) {
        abort(404);
    }

    return view('Book', ['book' => $book]);
});

Route::put('/books/{id}', function ($id) {
    $book = Book::findOrFail($id);

    $book->update([
        'title' => request('title'),
        'author' => request('author'),
        'published_year' => request('published_year'),
        'units_sold' => request('units_sold'),
        'remaining_stock' => request('remaining_stock'),
        'description' => request('description'),
    ]);

    return redirect("/books/{$id}")->with('success', 'Book updated successfully!');
});

Route::delete('/books/{id}', function ($id) {
    $book = Book::findOrFail($id);
    $book->delete();

    return redirect('/')->with('success', 'Book deleted successfully!');
});
