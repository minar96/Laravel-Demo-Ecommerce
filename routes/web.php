<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/contact', 'FontEnd\PagesController@contact')->name('contact');
Route::get('/', 'FontEnd\PagesController@index')->name('index');

//user notification route
Route::group(['prefix' => 'user'], function(){
	Route::get('/token/{token}', 'FontEnd\VerificationController@verify')->name('user.verification');
	Route::get('/dashboard', 'FontEnd\UsersController@dashboard')->name('user.dashboard');
	Route::get('/profile', 'FontEnd\UsersController@profile')->name('user.profile');
	Route::post('/profile/update', 'FontEnd\UsersController@profileUpdate')->name('user.profile.update');
});

//carts route
Route::group(['prefix' => 'carts'], function(){
	Route::get('/', 'FontEnd\CartsController@index')->name('carts');
	Route::post('/store', 'FontEnd\CartsController@store')->name('carts.store');
	Route::post('/update/{id}', 'FontEnd\CartsController@update')->name('carts.update');
	Route::post('/delete/{id}', 'FontEnd\CartsController@destroy')->name('carts.delete');
});

//checkout route
Route::group(['prefix' => 'checkouts'], function(){
	Route::get('/', 'FontEnd\CheckoutsController@index')->name('checkouts');
	Route::post('/store', 'FontEnd\CheckoutsController@store')->name('checkouts.store');
});

//products Routes
Route::group(['prefix' => 'products'], function(){
	Route::get('/', 'FontEnd\ProductsController@index')->name('products');
	Route::get('/{slug}', 'FontEnd\ProductsController@show')->name('products.show');
	Route::get('/new/search', 'FontEnd\PagesController@search')->name('search');


	//category routes
	Route::get('/categories', 'FontEnd\CategoriesController@index')->name('categories.index');
	Route::get('/category/{id}', 'FontEnd\CategoriesController@show')->name('categories.show');
});

//Admin
Route::group(['prefix' => 'admin'], function(){
	Route::get('/', 'BackEnd\PagesController@index')->name('admin.index');

	//admin login route
	Route::get('/login', 'Auth\admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/login/submit', 'Auth\admin\LoginController@login')->name('admin.login.submit');
	Route::post('/logout', 'Auth\admin\LoginController@logout')->name('admin.logout');

	// password email send
	Route::get('/password/reset', 'Auth\admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/resetPost', 'Auth\admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

	// password reset
	Route::get('/password/reset/{token}', 'Auth\admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
	Route::post('/password/reset', 'Auth\admin\ResetPasswordController@reset')->name('admin.password.reset.post');



//product

	Route::group(['prefix' => '/product'], function(){

		Route::get('/', 'BackEnd\ProductsController@index')->name('admin.products');
		Route::get('/create', 'BackEnd\ProductsController@create')->name('admin.product.create');
		Route::get('/edit/{id}', 'BackEnd\ProductsController@edit')->name('admin.product.edit');
		

		Route::post('/create', 'BackEnd\ProductsController@store')->name('admin.product.store');
		Route::post('/edit/{id}', 'BackEnd\ProductsController@update')->name('admin.product.update');
		Route::post('/delete/{id}', 'BackEnd\ProductsController@delete')->name('admin.product.delete');

	});

	//product orders
	Route::group(['prefix' => '/orders'], function(){

		Route::get('/index', 'BackEnd\OrdersController@index')->name('admin.order.index');
		Route::get('/view/{id}', 'BackEnd\OrdersController@show')->name('admin.order.show');
		Route::post('/delete/{id}', 'BackEnd\OrdersController@delete')->name('admin.order.delete');
		Route::post('/completed/{id}', 'BackEnd\OrdersController@completed')->name('admin.order.completed');
		Route::post('/paid/{id}', 'BackEnd\OrdersController@paid')->name('admin.order.paid');

		Route::post('/charge-update/{id}', 'BackEnd\OrdersController@chargeUpdate')->name('admin.order.charge');
		Route::get('/invoice/{id}', 'BackEnd\OrdersController@invoice')->name('admin.order.invoice');


	});

//product categroy
	Route::group(['prefix' => '/category'], function(){

		Route::get('/', 'BackEnd\CategoriesController@index')->name('admin.categories');
		Route::get('/create', 'BackEnd\CategoriesController@create')->name('admin.category.create');
		Route::get('/edit/{id}', 'BackEnd\CategoriesController@edit')->name('admin.category.edit');
		

		Route::post('/create', 'BackEnd\CategoriesController@store')->name('admin.category.store');
		Route::post('/edit/{id}', 'BackEnd\CategoriesController@update')->name('admin.category.update');
		Route::post('/delete/{id}', 'BackEnd\CategoriesController@delete')->name('admin.category.delete');

	});

	//product Brand
	Route::group(['prefix' => '/brands'], function(){

		Route::get('/', 'BackEnd\BrandsController@index')->name('admin.brands');
		Route::get('/create', 'BackEnd\BrandsController@create')->name('admin.brand.create');
		Route::get('/edit/{id}', 'BackEnd\BrandsController@edit')->name('admin.brand.edit');
		

		Route::post('/create', 'BackEnd\BrandsController@store')->name('admin.brand.store');
		Route::post('/edit/{id}', 'BackEnd\BrandsController@update')->name('admin.brand.update');
		Route::post('/delete/{id}', 'BackEnd\BrandsController@delete')->name('admin.brand.delete');

	});

	//Division route
	Route::group(['prefix' => '/divisions'], function(){

		Route::get('/', 'BackEnd\DivisionsController@index')->name('admin.divisions');
		Route::get('/create', 'BackEnd\DivisionsController@create')->name('admin.division.create');
		Route::get('/edit/{id}', 'BackEnd\DivisionsController@edit')->name('admin.division.edit');
		

		Route::post('/create', 'BackEnd\DivisionsController@store')->name('admin.division.store');
		Route::post('/edit/{id}', 'BackEnd\DivisionsController@update')->name('admin.division.update');
		Route::post('/delete/{id}', 'BackEnd\DivisionsController@delete')->name('admin.division.delete');

	});

	//District route
	Route::group(['prefix' => '/districts'], function(){

		Route::get('/', 'BackEnd\DistrictsController@index')->name('admin.districts');
		Route::get('/create', 'BackEnd\DistrictsController@create')->name('admin.district.create');
		Route::get('/edit/{id}', 'BackEnd\DistrictsController@edit')->name('admin.district.edit');
		

		Route::post('/create', 'BackEnd\DistrictsController@store')->name('admin.district.store');
		Route::post('/edit/{id}', 'BackEnd\DistrictsController@update')->name('admin.district.update');
		Route::post('/delete/{id}', 'BackEnd\DistrictsController@delete')->name('admin.district.delete');

	});

	//Slider route
	Route::group(['prefix' => '/sliders'], function(){

		Route::get('/', 'BackEnd\SlidersController@index')->name('admin.sliders');
		Route::post('/store', 'BackEnd\SlidersController@store')->name('admin.slider.store');
		Route::post('/update/{id}', 'BackEnd\SlidersController@update')->name('admin.slider.update');
		Route::post('/delete/{id}', 'BackEnd\SlidersController@delete')->name('admin.slider.delete');

	});
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//API routes

Route::get('get-districts/{id}', function($id){
	return json_encode(App\Models\District::where('division_id', $id)->get());
});