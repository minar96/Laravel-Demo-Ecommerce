@extends('FontEnd.layouts.master')

@section('title')
	{{ $product->title }}| Ecommerce Product
@endsection

@section('content')
	<!-- sidebar start -->
		<div class="widgets margin_top">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						  <div class="carousel-inner">
						    @php $i = 1; @endphp
						    @foreach($product->images as $image)
						    	<div class="  carousel-item {{ $i == 1 ? 'active':'' }}">
							      <img class="d-block w-100 bg-carousal" src="{{ asset('images/product/'.$image->image) }}" alt="First slide">
							    </div>
						    	@php $i++; @endphp
						    @endforeach
						  </div>
						  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
						    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
						    <span class="sr-only">Previous</span>
						  </a>
						  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
						    <span class="carousel-control-next-icon" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						  </a>
						</div>
						<div>
							<p>Category <span class="badge badge-info">{{ $product->category->name }}</span></p>
							<p>Brand <span class="badge badge-info">{{ $product->brand->name }}</span></p>
						</div>
					</div>
					<div class="col-md-8">
						<h2>{{ $product->title }}</h2>
						<h3>${{ $product->price }} 
							<span class="badge badge-primary">
								{{ $product->quantity <1 ? 'No item is available' : $product->quantity . 'item in stock'}}
							</span>
						</h3> <hr>

						<div class="">
							{{ $product->description }}
						</div>
						
					</div>	
				</div>
			</div>
		</div>
		<!-- sidebar start -->

@endsection