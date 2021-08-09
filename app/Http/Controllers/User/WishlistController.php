<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $product_id)
    {
        if(Auth::check()){
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id',$product_id)->first();

            if($exists == NULL){
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product_id,
                ]);
                return response()->json([
                    'success' => 'Product added to your wishlist',
                ]);
            }else{
                return response()->json([
                    'success' => 'Product alreay exits to your wishlist',
                ]);
            }

        }else{
            return response()->json([
                'error' => 'At First Login Your Account!!!',
            ]);
        }
    }
}
