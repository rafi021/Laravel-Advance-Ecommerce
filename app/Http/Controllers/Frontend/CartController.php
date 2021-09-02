<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    ]
            ]);

            return response()->json(['success' => 'Successfully added on your cart'],200);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->qty,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'size' => $request->size,
                    'color' => $request->color,
                    ]
            ]);
            return response()->json(['success' => 'Successfully added on your cart'],200);
        }
    }

    public function getMiniCart()
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

    public function removeMiniCart($rowId)
    {
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove from Cart'],200);
    }

}
