<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function stripeOrder(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51H8TlFIWhXor2KLbgApXVlRywj1JMseSwiAjsxIZisdoxBd51zJq0Mxayonagck8bydElHMKUgeuToL7y23SFP6H00i6EMPInx');

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
