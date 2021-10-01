<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutStoreRequest;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\Shipping;
use App\Models\ShipState;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkoutStore(CheckoutStoreRequest $request)
    {
        $data = [];
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_postCode'] = $request->shipping_postCode;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_notes'] = $request->shipping_notes;

        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = Cart::total();

        if($request->payment_method == 'stripe'){
            return view('frontend.payment.stripe', compact(
                'data',
                'cart_total',
            ));
        }elseif($request->payment_method == 'card'){
            return "card";
        }else{
            return view('frontend.payment.cod', compact(
                'data',
                'cart_total',
            ));
        }
    }

    public function getDistrict($division_id)
    {
        $districts = ShipDistrict::where('division_id','=', $division_id)->orderBy('district_name','ASC')->get();
        return json_encode($districts);
    }
    public function getState($district_id)
    {
        $states = ShipState::where('district_id','=', $district_id)->orderBy('state_name','ASC')->get();
        return json_encode($states);
    }

    public function checkoutPage()
    {
        if(Auth::check()){

            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cart_qty = Cart::count();
                $cart_total = Cart::total();

                $divisions = ShipDivision::with(['districts', 'states'])->latest()->get();
                //return $divisions;
                return view('frontend.checkout_page.checkout_page', compact(
                    'carts',
                    'cart_qty',
                    'cart_total',
                    'divisions'
                ));
            }else{
                $notification = [
                    'message' => 'Your shopping cart is empty!!',
                    'alert-type' => 'error'
                ];
                return redirect()->route('home')->with($notification);
            }
        }else{
            $notification = [
                'message' => 'You need to Login First for Checkout',
                'alert-type' => 'error'
            ];
            return redirect()->route('login')->with($notification);
        }
    }
}
