<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['category', 'publisher']);

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('author', 'like', "%{$q}%");
            });
        }
        if ($request->filled('category'))  $query->where('category_id', $request->category);
        if ($request->filled('publisher')) $query->where('publisher_id', $request->publisher);
        if ($request->filled('type'))      $query->where('type', $request->type);
        if ($request->filled('sale'))      $query->whereNotNull('old_price');

        $books = $query->orderBy('id')->paginate(12)->withQueryString();

        return view('shop.index', [
            'books'      => $books,
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'filters'    => $request->only(['q','category','publisher','type','sale']),
        ]);
    }

    public function deals()
    {
        $books = Book::with(['category','publisher'])
            ->whereNotNull('old_price')->orderBy('id')->paginate(12);

        return view('shop.index', [
            'books'      => $books,
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'filters'    => ['sale' => 1],
            'pageTitle'  => 'تخفیف‌های ویژه',
            'pageSub'    => 'کتاب‌های تخفیف‌دار — تا ۶۰٪ تخفیف',
        ]);
    }

    public function audiobooks()
    {
        $books = Book::with(['category','publisher'])
            ->where('type', 'a')->orderBy('id')->paginate(12);

        return view('shop.index', [
            'books'      => $books,
            'categories' => Category::all(),
            'publishers' => Publisher::all(),
            'filters'    => ['type' => 'a'],
            'pageTitle'  => 'کتاب‌های صوتی',
            'pageSub'    => 'گوش بده، راه برو — با صدای گویندگان حرفه‌ای',
        ]);
    }
}