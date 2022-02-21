<!DOCTYPE html>
<html>
<head>
	<title>
		@yield('title', 'Demo Ecommerce Project')
	</title>

	<meta name="csrf-token" content="{{ csrf_token() }}" />

	@include('FontEnd.partials.style')
</head>
<body>

	@include('FontEnd.partials.nav')
	@include('FontEnd.partials.massage')
	
	@yield('content')

		
	@include('FontEnd.partials.footer')
	@include('FontEnd.partials.scripts')

	@yield('scripts')
</body>
</html>