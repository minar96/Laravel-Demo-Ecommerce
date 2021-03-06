@extends('FontEnd.layouts.master')
@section('content')
    <div class="container margin-top-20">
    	<h2> My Cart Item</h2>
    	@if(App\Models\Cart::totalItem() > 0)
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
                @foreach(App\Models\Cart::totalCarts() as $cart)
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
        <div class="float-right">
            <a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue Shopping...</a>
            <a href="{{ route('checkouts') }}" class="btn btn-warning btn-lg">Checkout</a>
        </div>
        @else
            <div class="alert alert-warning">
                <strong>There Have No Item In Your Cart</strong>
            </div>
            <a href="{{ route('products') }}" class="btn btn-success btn-lg">Continue Shopping...</a>
        @endif
    </div>
@endsection