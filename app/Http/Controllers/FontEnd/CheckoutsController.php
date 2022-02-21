<?php

namespace App\Http\Controllers\FontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;

class CheckoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('priority', 'asc')->get();
        return view('FontEnd.pages.checkouts', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_no' => 'required',
            'shipping_address' => 'required',
            'payment_method' => 'required'
        ]);

        $order = new Order();

        //check transaction id is given or not

        if ($request->payment_method != 'cash_in') {
            if ($request->transaction_id == NULL || empty($request->transaction_id)) {
                session()->flash('sticky_errors', 'Please give your valid transaction code for this payment');
                return back();
            }
        }

        $order->name = $request->name;
        $order->email = $request->emailphone_no;
        $order->phone_no = $request->phone_no;
        $order->message = $request->message;
        $order->shipping_address = $request->shipping_address;
        $order->ip_address = request()->ip();
        $order->transaction_id = $request->transaction_id;

        $order->payment_id = Payment::where('short_name', $request->payment_method)->first()->id;

        if (Auth::check()) {
            $order->user_id = Auth::id();
        }

        $order->save();

        foreach (Cart::totalCarts() as $cart){
            $cart->order_id = $order->id;
            $cart->save();
        }

        session()->flash('success', 'Your payment is completed successfully!!..Just wait for admin conformation');
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
}
