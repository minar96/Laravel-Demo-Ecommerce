@extends('FontEnd.layouts.master')


@section('content')
    <div class="container">
    	<div class="row">
    		<div class="col-md-4">
    			<div class="list-group">
    				<a href="" class="list-group-item">
    					<img src="{{ App\Helpers\ImageHelper::getUser(Auth::user()->id) }}" style="width: 60px;" class="img rounded-circle" alt="">
    				</a>
    				<a href="{{ route('user.dashboard') }}" class="list-group-item {{ Route::is('user.dashboard')? 'active' : '' }}">Dashboard</a>
    				<a href="{{ route('user.profile') }}" class="list-group-item {{ Route::is('user.profile')? 'active' : '' }}">Update Profile</a>
    				<a href="" class="list-group-item">logout</a>
    			</div>
    		</div>
    		<div class="col-md-8">
    			<div class="card card-body">
    				@yield('sub-content')
    			</div>
    		</div>
    	</div>
    </div>
    
@endsection