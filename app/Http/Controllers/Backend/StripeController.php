<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripeOrder(Request $request)
    {
        $stripePrivateKey = env('STRIPE_SECRET');
        \Stripe\Stripe::setApiKey($stripePrivateKey);

        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
        'amount' => 999*100,
        'currency' => 'usd',
        'description' => 'Al Araf Fashion Store',
        'source' => $token,
        'metadata' => ['order_id' => '6735'],
        ]);

        dd($charge);
    }
}
