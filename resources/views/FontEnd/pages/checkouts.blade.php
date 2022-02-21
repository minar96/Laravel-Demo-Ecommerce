@extends('FontEnd.layouts.master')


@section('content')
	<div class="container margin-top-20">
		<div class="card card-body">
			<h2>Confirm Item</h2>
			<hr>
			<div class="row">
				<div class="col-md-7">
					@foreach(App\Models\Cart::totalCarts() as $cart)
						<p>
							{{ $cart->product->title }}-
							Price- <strong>{{ $cart->product->price }}</strong> $
							-{{ $cart->product_quantity }} Item
						</p>
					@endforeach

					<button class="btn btn-outline-primary">
						<a href="{{ route('carts') }}">Change Cart Items</a>
					</button>

				</div>

				<div class="col-md-5 border-left">
					@php
						$total_price = 0;
					@endphp
					@foreach(App\Models\Cart::totalCarts() as $cart)
						@php
							$total_price += $cart->product->price * $cart->product_quantity;
						@endphp
					@endforeach

					<p>Total Price: <strong>{{ $total_price }}</strong>$</p>
					<p>Total Price with Shipping Cost: <strong>{{ $total_price + App\Models\Setting::first()->shipping_cost}}</strong>$</p>
				</div>
			</div>
		</div>
		<div class="card card-body">
			<h2>Shipping Address</h2>
			<hr>

			 <form method="POST" action="{{ route('checkouts.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>

                            <div class="col-md-6">
  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check()? Auth::user()->first_name.' '.Auth::user()->last_name : '' }}"  autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value=" {{ Auth::check()? Auth::user()->email : '' }} " autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone_no" type="phone_no" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value=" {{ Auth::check()? Auth::user()->phone_no : '' }} "  autocomplete="phone_no">

                                @error('phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>

                            <div class="col-md-6">
                                <textarea id="message" type="text" class="form-control @error('message') is-invalid @enderror" name="message" rows="4" autocomplete="message"> </textarea>

                                @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address') }}</label>

                            <div class="col-md-6">
                                <textarea id="shipping_address" type="text" class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows="4" autocomplete="shipping_address"> {{ Auth::check()? Auth::user()->shipping_address : '' }} </textarea>

                                @error('shipping_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>

                            <div class="col-md-6">
                                <select name="payment_method" class="form-control" id="payments">
                                	<option value="">Please a select a payment method</option>
                                	@foreach($payments as $payment)
                                		<option value="{{ $payment->short_name }}">{{ $payment->name }}</option>
                                	@endforeach
                                </select>
                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @foreach($payments as $payment)
                                          @if($payment->short_name == 'cash_in')
                                            <div class=" mt-2 hidden alert alert-success" id="payment_{{ $payment->short_name }}">
                                                <h4>For cash in there is nothing necessary. Just click Finish Order</h4>
                                                <p>You will get product within two or three busniess days</p>
                                            </div>
                                        @else
                                            <div class=" mt-2 hidden" id="payment_{{ $payment->short_name }}">
                                                <h4>{{ $payment->name }} Payment</h4>
                                                <p>
                                                    {{ $payment->name }} No : {{ $payment->no }}
                                                    <br>
                                                    Account Type: {{ $payment->type }}
                                                </p>
                                                <div class="alert alert-success">
                                                    <p>Please send the money above to this Payment No and write your transaction code below there.</p>
                                                </div>
                                                
                                            </div>
                                          @endif
                                      {{-- </div>  --}}
                                @endforeach
                                <input type="text" class="hidden form-control" name="transaction_id" id="transaction_id" placeholder="Write your transaction code here.">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Order Now') }}
                                </button>
                            </div>
                        </div>
                    </form>
		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $("#payments").change(function() {
            $payment_method = $("#payments").val();
            // alert($payment_method);
            // $("#paymentDiv").removeClass('hidden');
            if ($payment_method == 'cash_in') {
               $("#payment_cash_in").removeClass('hidden'); 
               $("#payment_bkash").addClass('hidden'); 
               $("#payment_rocket").addClass('hidden'); 
               $("#transaction_id").addClass('hidden'); 

            }
            else if ($payment_method == 'bkash'){
                $("#payment_bkash").removeClass('hidden');
                $("#payment_cash_in").addClass('hidden'); 
                $("#payment_rocket").addClass('hidden');
                $("#transaction_id").removeClass('hidden');  

            }else if ($payment_method == 'rocket'){
                $("#payment_rocket").removeClass('hidden'); 
                $("#payment_cash_in").addClass('hidden'); 
                $("#payment_bkash").addClass('hidden');
               $("#transaction_id").removeClass('hidden'); 

            }
             
            
        })
    </script>
@endsection