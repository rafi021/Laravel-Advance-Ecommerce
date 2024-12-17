<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function orderHistory()
    {
        $orders = Order::whereUserId(Auth::id())->orderBy('id', 'DESC')->get();
        return view('frontend.order.order-history', compact('orders'));
    }
}
