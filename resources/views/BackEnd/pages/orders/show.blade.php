@extends('BackEnd.layouts.master')

@section('content')

<div class="main-panel">
  <div class="container">
    <div class="row">
          <div class="content-wrapper">
            <div class="card ">
              <div class="card-header">
                  View Order #LC{{ $order->id }}
              </div>
              <div class="card-body">

                @include('BackEnd.partials.message')
                <h3>Orderer Information</h3>
                <div class="row">
                  <div class="col-md-6 border-right">
                    <p><strong>Order Name: </strong>{{ $order->name }}</p>
                    <p><strong>Order Phone Number: </strong>{{ $order->phone_no }}</p>
                    <p><strong>Order Email: </strong>{{ $order->email }}</p>
                    <p><strong>Order Shipping Address: </strong>{{ $order->shipping_address }}</p>
                  </div>
                  <div class="col-md-6">
                    <p><strong>Order Payment Method: </strong>{{ $order->payment->name }}</p>
                    <p><strong>Order Payment Transaction: </strong>{{ $order->transaction_id }}</p>
                  </div>
                </div>
                <hr>
                <h3>Order Items</h3>
                @if($order->carts->count() > 0)
            <table class="table table-bordered table-stripe">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>Product Title</th>
                    <th>Product image</th>
                    <th>Product Quantity</th>
                    <th>Unit Price</th>
                    <th>Sub total Price</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->carts as $cart)
                <tr>
                    @php
                        $total_price = 0;
                    @endphp
                    <td>{{ $loop->index +1 }}</td>
                    <td>
                        <a href="{{ route('products.show', $cart->product->slug) }}">{{ $cart->product->title }}</a>
                    </td>
                    <td>
                        @if($cart->product->images->count()>0)
                            <img src="{{ asset('images/product/'. $cart->product->images->first()->image) }}" width="60px">
                        @endif
                    </td>
                    <td>
                        <form class="form-inline" action="{{ route('carts.update', $cart->id) }}" method="post">
                            @csrf
                            <input type="number" name="product_quantity" class="form-control" value="{{ $cart->product_quantity }}">
                            <button type="submit" class="btn btn-success ml-1">Update</button>
                        </form>
                    </td>
                    <td>
                        {{ $cart->product->price }}$
                    </td>
                    @php
                        $total_price += $cart->product->price * $cart->product_quantity;
                    @endphp
                    <td>
                        {{ $cart->product->price * $cart->product_quantity }}$
                    </td>
                    <td>
                        <form class="form-inline" action="{{ route('carts.delete', $cart->id) }}" method="post">
                            @csrf
                            <input type="hidden" name="cart_id">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                <td colspan="4"></td>
                <td>Total Amount:</td>
                <td colspan="2">
                    <strong>{{ $total_price }}$</strong>
                </td>
            </tbody>        
        </table>
        {{-- <div class="float-right">
            <a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue Shopping...</a>
            <a href="{{ route('checkouts') }}" class="btn btn-warning btn-lg">Checkout</a>
        </div>
        @else
            <div class="alert alert-warning">
                <strong>There Have No Item In Your Cart</strong>
            </div>
            <a href="{{ route('products') }}" class="btn btn-success btn-lg">Continue Shopping...</a> --}}
        @endif
        <hr>
        <form action="{{ route('admin.order.charge', $order->id) }}" method="post">
          @csrf
          <label for="">Shipping Charge:</label>
            <input type="number" class="form-control" name="shipping_cost" id="shipping_cost" value="{{ $order->shipping_cost }}">

            <label for="">Coustom Discount:</label>
            <input type="number" class="form-control" name="coustom_discount" id="coustom_discount" value="{{ $order->coustom_discount }}">
            <input type="submit" class="btn btn-info mt-2" value="update">
            <a href="{{ route('admin.order.invoice', $order->id) }}" class="btn btn-primary mt-2 float-right">Generate Invoice</a>
        </form>
        <hr>
        {{-- <p> --}}
          <form action="{{ route('admin.order.completed', $order->id) }}" style="display: inline !important;" method="post">
          @csrf
          @if($order->is_completed)
            <input type="submit" class="btn btn-danger" value="Cancel Order">
          @else
            <input type="submit" class="btn btn-success" value="Completed Order">
          @endif
        </form>
        {{-- </p> --}}
        {{-- <p style="display: inline !important;"> --}}
          <form action="{{ route('admin.order.paid', $order->id) }}" style="display: inline !important;" method="post">
          @csrf
          @if($order->is_paid)
            <input type="submit" class="btn btn-warning" value="Cancel Payment">
          @else
            <input type="submit" class="btn btn-info" value="Paid Order">
          @endif
          
        </form>
        {{-- </p> --}}
              </div>
            </div>
          </div>
    </div>
  </div>
        
</div>

@endsection