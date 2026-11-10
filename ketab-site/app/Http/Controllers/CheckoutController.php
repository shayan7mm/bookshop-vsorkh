<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function form()
    {
        $items = CartService::items();
        if ($items->isEmpty()) {
            return redirect()->route('cart')->with('ok', 'سبد خرید خالی است.');
        }

        return view('checkout.form', [
            'items' => $items,
            'total' => CartService::total(),
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'address' => ['required', 'string', 'min:10', 'max:500'],
            'phone'   => ['required', 'regex:/^09\d{9}$/'],
        ], [
            'address.required' => 'آدرس را وارد کنید.',
            'address.min'      => 'آدرس باید حداقل ۱۰ کاراکتر باشد.',
            'phone.required'   => 'شماره تماس الزامی است.',
            'phone.regex'      => 'شماره تماس باید با 09 شروع شود.',
        ]);

        $items = CartService::items();
        if ($items->isEmpty()) {
            return redirect()->route('cart');
        }

        $total = CartService::total();

        DB::transaction(function () use ($request, $items, $total) {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total'   => $total,
                'status'  => 'paid',
                'address' => $request->input('address'),
                'phone'   => $request->input('phone'),
            ]);

            foreach ($items as $it) {
                $order->items()->create([
                    'book_id' => $it->book_id,
                    'qty'     => $it->qty,
                    'price'   => $it->book->price,
                ]);
            }

            // سبد رو خالی کن
            \App\Models\Cart::where(CartService::key())->delete();
        });

        return redirect()->route('orders')->with('ok', 'پرداخت با موفقیت انجام شد. سفارش شما ثبت شد.');
    }

    public function orders()
    {
        $orders = Order::with('items.book')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('checkout.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        abort_unless($order->user_id === Auth::id(), 403);
        $order->load('items.book');

        return view('checkout.order-show', compact('order'));
    }
}