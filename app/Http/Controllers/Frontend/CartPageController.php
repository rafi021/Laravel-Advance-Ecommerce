<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Cart;
use Illuminate\Http\Request;
use Prophecy\Call\Call;

class CartPageController extends Controller
{
    public function myCartView()
    {
        $categories = Category::with(['subcategory', 'subsubcategory', 'products'])->orderBy('category_name_en', 'ASC')->get();
        return view('frontend.frontend_layout.cart_page.mycart_view', compact('categories'));
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

    public function addQtyToCart($rowId)
    {
        $cart_product=Cart::get($rowId);
        Cart::update($rowId, $cart_product->qty + 1);
        return response()->json(['success' => 'Product Qty Increamented'],200);
    }

    public function reduceQtyFromCart($rowId)
    {
        $cart_product=Cart::get($rowId);
        Cart::update($rowId, $cart_product->qty - 1);
        return response()->json(['error' => 'Product Qty Decremented'],200);
    }
}
