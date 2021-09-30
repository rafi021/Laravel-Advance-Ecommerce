<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupon;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
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
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
        }
        return response()->json(['success' => 'Product Remove from Cart'],200);
    }

    public function addQtyToCart($rowId)
    {
        $cart_product=Cart::get($rowId);
        Cart::update($rowId, $cart_product->qty + 1);

        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
        }
        return response()->json(['success' => 'Product Qty Increamented'],200);
    }

    public function reduceQtyFromCart($rowId)
    {
        $cart_product=Cart::get($rowId);
        Cart::update($rowId, $cart_product->qty - 1);
        if (Session::has('coupon')) {
            $coupon_name = Session::get('coupon')['coupon_name'];
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
        }
        return response()->json(['error' => 'Product Qty Decremented'],200);
    }

    public function applyCoupon(Request $request)
    {
        //dd($request->all());
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();
        if ($coupon) {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100)
            ]);
            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
        }else{
            return response()->json(['error' => 'Invalid Coupon'],200);
        }
    }
        public function couponCalculation()
        {
            if (Session::has('coupon')) {
                return response()->json([
                    'subtotal' => Cart::total(),
                    'coupon_name' => session()->get('coupon')['coupon_name'],
                    'coupon_discount' => session()->get('coupon')['coupon_discount'],
                    'discount_amount' => session()->get('coupon')['discount_amount'],
                    'total_amount' => session()->get('coupon')['total_amount'],
                ],200);
            }else{
                return response()->json([
                    'total' => Cart::total(),
                ],200);
            }
        }

        public function couponRemove()
        {
            if(Session::has('coupon')){
                Session::forget('coupon');
                return response()->json(array('success' => 'Coupon Applied Successfully'));
            }else{
                return response()->json(['error' => 'Invalid Coupon'], 200);
            }
        }
}
