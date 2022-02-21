<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Brand;

use Image;
use File;



class BrandsController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }
   public function index()
   {
   	$brands = Brand::orderBy('id', 'desc')->get();
   	return view('BackEnd.pages.brands.index', compact('brands'));
   }

   public function create()
   {
   	return view('BackEnd.pages.brands.create');
   }

   public function store(Request $request)
   {
   	$request->validate([
   		'name' => 'required',
   		'description' => 'required',
   		'image' => 'nullable|image',

   	],
   	[
   		'name.required' => 'Please Provide Brand Name',
   		'image.image' => 'Insert a valid image like .jpg, .png extension',
   	]);


   	$brand = new Brand();

   	$brand->name = $request->name;
   	$brand->description = $request->description;

   	if(count($request->image) > 0){
   		$image = $request->file('image');
    	$img = time() . '.' . $image->getClientOriginalExtension();
	    $location = public_path('images/brand/' .$img);

	    Image::make($image)->save($location);

	    $brand->image = $img;
    	}

   	$brand->save();
   	session()->flash('success', 'This brand has added successfully.');
   	return redirect()->route('admin.brands');
   }

   public function edit($id)
   {
   	$brand = Brand::find($id);
   	if (!is_null($brand)) {
   		return view('BackEnd.pages.brands.edit', compact('brand'));
   	}else{
   		return redirect()->route('admin.brands');
   	}
   }


   public function update(Request $request, $id)
   {
   	$request->validate([
   		'name' => 'required',
   		'description' => 'required',
   		'image' => 'nullable|image',

   	],
   	[
   		'name.required' => 'Please Provide Brand Name',
   		'image.image' => 'Insert a valid image like .jpg, .png extension',
   	]);


   	$brand = Brand::find($id);

   	$brand->name = $request->name;
   	$brand->description = $request->description;


   	if(count($request->image) > 0){
   		//Deleted image form folder
   		if (File::exists('images/brand/'.$brand->image)) {
   			File::delete('images/brand/'.$brand->image);
   		}
   		$image = $request->file('image');
    	$img = time() . '.' . $image->getClientOriginalExtension();
	    $location = public_path('images/brand/' .$img);

	    Image::make($image)->save($location);

	    $brand->image = $img;
    	}

   	$brand->save();
   	session()->flash('success', 'This brand has updated successfully.');
   	return redirect()->route('admin.brands');
   }

   public function delete($id)
    {
    	$brand = Brand::find($id);
    	if(!is_null($brand))
    	{
    		//Delete brand image
    		if (File::exists('images/brand/'.$brand->image)) {
   			File::delete('images/brand/'.$brand->image);
   			}
    		$brand->delete();
    	}
    session()->flash('success', 'This session has been delete successfully!!');
    return back();
    }
}
