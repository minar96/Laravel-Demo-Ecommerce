@extends('FontEnd.pages.users.master')



@section('sub-content')
    <div class="container mt-3">
    	{{-- <div class="row"> --}}

    		<h2>Welcome {{ $user->first_name. ' '. $user->last_name }}</h2>

    		<p>This is your Dashboard. You can change and update your profile. </p>
    	</div>
    	<div class="row">
    		<div class="col-md-4">
    			<div class="card card-body pointer mt-2" onclick="location.href='{{ route('user.profile') }}' ">
    				<h4>Update Profile</h4>
    			</div>
    		</div>
    	{{-- </div> --}}
    </div>
    
@endsection