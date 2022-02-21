<?php

namespace App\Http\Controllers\FontEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Slider;

class PagesController extends Controller
{
    
    public function contact()
    {
    	return view('FontEnd.pages.contact');
    }

    public function index()
    {
    	$sliders = Slider::orderBy('priority', 'asc')->get();
        $products = Product::orderBy('id', 'desc')->paginate(3);
    	return view('FontEnd.pages.index', compact('products', 'sliders'));
    }

    public function search(Request $request)
    {
    	$search = $request->search;

    	$products = Product::orWhere('title', 'like', '%'.$search.'%')
    	->orWhere('description', 'like', '%'.$search.'%')
    	->orWhere('slug', 'like', '%'.$search.'%')
    	->orWhere('price', 'like', '%'.$search.'%')
    	->orWhere('quantity', 'like', '%'.$search.'%')
    	->orWhere('offer_price', 'like', '%'.$search.'%')
    	->orderBy('id', 'desc')
    	->paginate(3);
    	return view('FontEnd.pages.product.search', compact('search', 'products'));
    }
    
}
