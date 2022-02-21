<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;

use Auth;

class CartsController extends Controller
{
    
    public function store(Request $request)
    {
       $this->validate($request, [
        'product_id' => 'required'
       ],
        [
            'product_id.required' => 'Gives your Product'
        ]);

       if (Auth::check()) {
          $carts = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->where('order_id', NULL)
                    ->first();
       }else{
        $carts = Cart::where('ip_address', request()->ip())
                    ->where('product_id', $request->product_id)
                    ->where('order_id', NULL)
                    ->first();
       }

        if (!is_null($carts)) {
            $carts->increment('product_quantity');
        }else{
           $carts = new Cart();

           if (Auth::check()) {
               $carts->user_id = Auth::id();
           }

           $carts->ip_address = request()->ip();
           $carts->product_id = $request->product_id;
           $carts->save(); 
        }

       return json_encode(['status' => 'success', 'Message' => 'Item added to cart', 'totalItems' => Cart::totalItem()]);
    }

    
}
