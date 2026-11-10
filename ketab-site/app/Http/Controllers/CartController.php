<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $items = CartService::items();
        $total = CartService::total();

        return view('cart.index', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['book_id' => 'required|exists:books,id']);

        $bookId = $request->integer('book_id');
        $qty = max(1, $request->integer('qty', 1));
        $key = CartService::key();

        $cart = Cart::where($key)->where('book_id', $bookId)->first();

        if ($cart) {
            $cart->increment('qty', $qty);
        } else {
            Cart::create(array_merge($key, [
                'book_id' => $bookId,
                'qty'     => $qty,
            ]));
        }

        if ($request->expectsJson()) {
            return response()->json([
                'ok'    => true,
                'count' => CartService::count(),
                'total' => CartService::total(),
            ]);
        }

        return back()->with('ok', 'به سبد اضافه شد');
    }

    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'qty'     => 'required|integer|min:0',
        ]);

        $key = CartService::key();
        $qty = $request->integer('qty');

        if ($qty <= 0) {
            Cart::where($key)->where('book_id', $request->integer('book_id'))->delete();
        } else {
            Cart::where($key)->where('book_id', $request->integer('book_id'))->update(['qty' => $qty]);
        }

        return $request->expectsJson()
            ? response()->json(['ok' => true, 'count' => CartService::count(), 'total' => CartService::total()])
            : back();
    }

    public function remove(Request $request)
    {
        $request->validate(['book_id' => 'required|exists:books,id']);

        Cart::where(CartService::key())->where('book_id', $request->integer('book_id'))->delete();

        return $request->expectsJson()
            ? response()->json(['ok' => true, 'count' => CartService::count(), 'total' => CartService::total()])
            : back();
    }

    public function count()
    {
        return response()->json([
            'count' => CartService::count(),
            'total' => CartService::total(),
        ]);
    }
}