<?php
namespace App\Http\Controllers;

use App\Models\Magazine;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::latest()->paginate(9);

        return view('magazine.index', compact('magazines'));
    }

    public function show(Magazine $magazine)
    {
        $related = Magazine::where('id', '!=', $magazine->id)
            ->latest()
            ->take(3)
            ->get();

        return view('magazine.show', compact('magazine', 'related'));
    }
}