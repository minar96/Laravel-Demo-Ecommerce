<?php

namespace App\Http\Controllers\FontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cart;
use App\Models\Order;

use Auth;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FontEnd.pages.carts');
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

       session()->flash('success', 'Product are added Successfully!!');
       return back();
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
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->product_quantity = $request->product_quantity;
            $cart->save();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('success', 'Cart item has updated Successfully!!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::find($id);
        if (!is_null($cart)) {
            $cart->delete();
        }else{
            return redirect()->route('carts');
        }
        session()->flash('errors', 'Cart item has deleted Successfully!!');
        return back();
    }
}
