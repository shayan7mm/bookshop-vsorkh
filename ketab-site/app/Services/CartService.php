<?php
namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartService
{
    public static function key(): array
    {
        return auth()->check()
            ? ['user_id' => auth()->id(), 'session_id' => null]
            : ['user_id' => null, 'session_id' => session()->getId()];
    }

    public static function count(): int
    {
        return (int) Cart::where(self::key())->sum('qty');
    }

    public static function items()
    {
        return Cart::with('book')->where(self::key())->get();
    }

    public static function total(): int
    {
        return (int) Cart::where(self::key())
            ->join('books', 'books.id', '=', 'carts.book_id')
            ->sum(DB::raw('books.price * carts.qty'));
    }
}