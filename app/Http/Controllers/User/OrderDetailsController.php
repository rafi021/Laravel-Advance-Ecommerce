<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderDetailsController extends Controller
{
    public function userOrderDetails($order_id)
    {
        $order = Order::whereId($order_id)->where('user_id', Auth::id())
            ->with(['user', 'division', 'district', 'state'])
            ->first();
        $orderItems = OrderItem::where('order_id', $order->id)
            ->with('product')
            ->orderBy('id', 'DESC')->get();

            //return $orderItems;
        return view('frontend.order.order-details', compact(
            'order',
            'orderItems'
        ));
    }

    public function userInvoiceDownload($order_id)
    {
        $order = Order::whereId($order_id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::where('order_id', $order->id)->orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('frontend.order.invoice-download', compact('order','orderItems'))
            ->setPaper('a4')
            ->setOptions([
                'tempDir' => public_path(),
                'chroot' => public_path(),
            ]);
        return $pdf->download('invoice.pdf');
    }
}
