<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cart;
use Illuminate\Http\Request;

class CartPageController extends Controller
{
    public function myCartView()
    {
        return view('frontend.frontend_layout.cart_page.mycart_view');
    }
    public function showmyCartList()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => round($cart_total),
        ], 200);
    }

    public function removeFromCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart'],200);
    }
}
