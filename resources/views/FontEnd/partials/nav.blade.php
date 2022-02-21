<!-- navbar start -->
{{-- <div class="container"> --}}
<div class="warper">
				
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand nav-color" href="{{ route('index') }}">Ecommerce</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto ">
				<li class="nav-item active">
					<a class="nav-link nav-color" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link nav-color" href="{{ route('products') }}">Products</a>
				</li>
					      
				<li class="nav-item">
					<a class="nav-link nav-color" href="{{ route('contact') }}">Contact</a>
				</li>
				<form class="form-inline my-2 my-lg-0" action="{{ route('search') }}" method="get">
					 <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search your product" aria-label="Search">
						      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
						      	<i class="fa fa-search"></i>
						      </button>
						    </form>
						     
					    
						    
						  </div>
						  </ul>
						  <ul class="navbar-nav ml-auto ">
						  	<!-- Authentication Links -->
						  	<li class="nav-item">
				                <a class="nav-link" href="{{ route('carts') }}">
				                	<button class="btn btn-outline-success">
				                		<span>Cart</span>
				                		<span class="badge badge-success p-2" id="totalItems">
				                			{{ App\Models\Cart::totalItem() }}
				                		</span>
				                	</button>
				                </a>
	                         </li>
	                        @guest
	                        
	                     {{-- </ul> --}}
	                     {{-- <ul class="navbar-nav ml-auto"> --}}


	                       <li class="nav-item">
	                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
	                            </li>
	                            @if (Route::has('register'))
	                                <li class="nav-item">
	                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
	                                </li>
	                            @endif
	                        @else
	                            <li class="nav-item dropdown">
	                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
	                <img src="{{ App\Helpers\ImageHelper::getUser(Auth::user()->id) }}" style="width: 40px;" class="img rounded-circle" alt="">
	               {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <span class="caret"></span>
	                                </a>

	                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
	                                    <a class="dropdown-item" href="{{ route('user.dashboard') }}">
	                                        {{ __('My Dashboard') }}
	                                    </a>

										<a class="dropdown-item" href="{{ route('logout') }}"
	                                       onclick="event.preventDefault();
	                                                     document.getElementById('logout-form').submit();">
	                                        {{ __('Logout') }}
	                                    </a>

	                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                        @csrf
	                                    </form>
	                                </div>
	                            </li>
	                        @endguest
						  </ul>

					</nav>
				</div>
			{{-- </div> --}}
			<!-- navbar end -->
