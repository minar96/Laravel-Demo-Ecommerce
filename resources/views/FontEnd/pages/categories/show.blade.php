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
						<h2>All Products <span class="badge badge-info">{{ $category->name }}</span> catgory</h2>
						@php
							$products = $category->products()->paginate(3);
						@endphp
						@if($products->count() > 0 )
							@include('FontEnd.pages.product.partials.all_products')
						@else
							<div class="alert alert-warning">
								There have no product!!
							</div>
						@endif
					</div>	
				</div>
			</div>
		</div>
		<!-- sidebar start -->

@endsection