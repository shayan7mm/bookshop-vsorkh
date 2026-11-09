<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Magazine;
use App\Models\Publisher;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
      
        $books = Book::with(['category', 'publisher'])->orderBy('id')->get();

        return view('home', [
            'books'      => $books,
            'heroBooks'  => $books->take(3),
            'audioBook'  => $books->firstWhere('type', 'a'),
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'magazines'  => Magazine::latest()->take(3)->get(),
            'reviews'    => Review::all(),
        ]);
    }
}