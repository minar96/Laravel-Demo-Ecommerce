@extends('FontEnd.layouts.master')


@section('content')
	<!-- sidebar start -->
		<div class="widgets margin_top">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						@include('FontEnd.partials.product-sidebar')
					</div>
					<div class="col-md-8">
						<h2>Searched Product For - <span class="badge badge-primary">{{ $search }}</span></h2>
						@include('FontEnd.pages.product.partials.all_products')
					</div>	
				</div>
			</div>
		</div>
		<!-- sidebar start -->

@endsection