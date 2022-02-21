<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Order;

use PDF;

class OrdersController extends Controller
{
  	public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
    	$orders = Order::orderBy('id', 'desc')->get();
        return view('BackEnd.pages.orders.index', compact('orders'));
    }
    public function show($id)
    {
    	$order = Order::find($id);
    	$order->is_seen_by_admin = 1;
    	$order->save();
        return view('BackEnd.pages.orders.show', compact('order'));
    }

    public function completed($id)
    {
    	$order = Order::find($id);
    	if ($order->is_completed) {
    		$order->is_completed = 0;
    	}else{
    		$order->is_completed = 1;
    	}
    	$order->save();
    	session()->flash('success', 'Order is completed successfully!!!');
    	return back();
    }

    public function chargeUpdate(Request $request, $id)
    {
        $order = Order::find($id);
        
        $order->shipping_cost = $request->shipping_cost;
        $order->coustom_discount = $request->coustom_discount;
        $order->save();
        session()->flash('success', 'Shipping Cost and Discount has added successfully!!!');
        return back();
    }
    /**
     * generate invoice
     */
    public function invoice($id)
    {
        $order = Order::find($id);
        
    $pdf = PDF::loadView('BackEnd.pages.orders.invoice', compact('order'));
    // $pdf->stream('invoice.pdf');
    return $pdf->stream('invoice.pdf');
    }

    public function paid($id)
    {
    	$order = Order::find($id);
    	if ($order->is_paid) {
    		$order->is_paid = 0;
    	}else{
    		$order->is_paid = 1;
    	}
    	$order->save();
    	session()->flash('success', 'Order is Payment Paid successfully!!!');
    	return back();
    }
    // public function delete($id)
    // {
    // 	$product = Product::find($id);
    // 	if(!is_null($product))
    // 	{
    // 		$product->delete();
    // 	}
    // session()->flash('success', 'This session has been delete successfully!!');
    // return back();
    // }  
}
