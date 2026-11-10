<?php
namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function show(Book $book)
    {
        $related = Book::where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        if ($related->count() < 4) {
            $more = Book::where('id', '!=', $book->id)
                ->whereNotIn('id', $related->pluck('id'))
                ->take(4 - $related->count())
                ->get();
            $related = $related->merge($more);
        }

        return view('book.show', compact('book', 'related'));
    }
}