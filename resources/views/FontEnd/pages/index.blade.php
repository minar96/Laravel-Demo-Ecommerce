@extends('FontEnd.layouts.master')


@section('content')
	<!-- sidebar start -->
		<div class="widgets">
			<div class="our_slider">
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
  	@foreach($sliders as $slider)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->index == 0 ? 'active' :'' }}"></li>
    @endforeach
  </ol>
  <div class="carousel-inner">
  	@foreach($sliders as $slider)
    <div class="carousel-item {{ $loop->index == 0 ? 'active' :'' }}">
      <img class="d-block w-100" src="{{ asset('images/sliders/' .$slider->image) }}" alt="{{ $slider->title }}" style="height: 410px;">
  {{-- <div class="carousel-item"> --}}
  <div class="carousel-caption d-none d-md-block">
    <h5 style="color: #000; font-size: 1.5rem;">{{ $slider->title }}</h5>
    <p>
    	@if($slider->button_text)
    		<a href="{{ $slider->button_link }}" class="btn btn-success">{{ $slider->button_text }}</a>
    	@endif
    </p>
  </div>
{{-- </div> --}}
    </div>
    @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						@include('FontEnd.partials.product-sidebar')
					</div>
					<div class="col-md-8">
						<h2>Featured Product</h2>
						@include('FontEnd.pages.product.partials.all_products')
					</div>	
				</div>
			</div>
		</div>
		<!-- sidebar start -->

@endsection