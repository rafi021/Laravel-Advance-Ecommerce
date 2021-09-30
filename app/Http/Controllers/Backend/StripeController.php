<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function stripeOrder(Request $request)
    {
        // dd($request->all());

        // Session Coupon check
        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }

        // Stripe Service area
        $stripePrivateKey = env('STRIPE_SECRET');
        \Stripe\Stripe::setApiKey($stripePrivateKey);

        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => $total_amount*100,
        'currency' => 'usd',
        'description' => 'Al Araf Fashion Store',
        'source' => $token,
        'metadata' => ['order_id' => uniqid()],
        ]);

        // Order Service Area
        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->input('division_id'),
            'district_id' => $request->input('district_id'),
            'state_id' => $request->input('state_id'),
            'name' => $request->input('shipping_name'),
            'email' => $request->input('shipping_email'),
            'phone' => $request->input('shipping_phone'),
            'post_code' => $request->input('shipping_postCode'),
            'notes' => $request->input('shipping_notes'),
            'address' => $request->input('shipping_address'),
            'payment_type' => $charge->payment_method,
            'payment_method' => 'Stripe',
            'transaction_id' =>  $charge->balance_transaction,
            'currency' => $charge->currency,
            'amount' => $total_amount,
            'order_number' => $charge->metadata->order_id,
            'address' => $request->input('shipping_address'),
            'address' => $request->input('shipping_address'),
            'invoice_number' => 'AAF'.mt_rand(10000000,99999999),
            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),
            'status' => 'pending',
            'created_at' => Carbon::now(),
        ]);

         // Start Send Email
            $invoice = Order::findOrFail($order_id);
            $data = [
                'invoice_no' => $invoice->invoice_number,
                'amount' => $total_amount,
                'name' => $invoice->name,
                'email' => $invoice->email,
            ];

            Mail::to($invoice->email)->send(new OrderMail($data));

            // End Send Email


        // Cart Service Area
        $carts = Cart::content();
        foreach ($carts as $key => $cart) {
            OrderItem::create([
                'order_id' => $order_id,
                'product_id' => $cart->id,
                'color' => $cart->options->color,
                'size' => $cart->options->size,
                'qty' => $cart->qty,
                'unit_price' => $cart->price,
            ]);
        }

        // After OrderItem Store forget coupon
        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        // Then Destroy cart
        Cart::destroy();

        $notification = array(
			'message' => 'Your Order Place Successfully',
			'alert-type' => 'success'
		);

		return redirect()->route('dashboard')->with($notification);
    }
}
