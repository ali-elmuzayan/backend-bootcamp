<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title'); 
        $books = Book::when($title, fn($query, $title) => $query->title($title))->popular()->highestRated()->get(); 

        return view('books/index', [
            'books' => $books
        ]); 
    }

    // Display the specified resource.
    public function show(Book $book)
    {
        $book->load([
            'reviews' => fn($query) => $query->latest(),
        ]);

        return view('books.show', ['book' => $book]);
    }


}
