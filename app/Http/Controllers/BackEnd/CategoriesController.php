<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Category;

use Image;
use File;



class CategoriesController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }
   public function index()
   {
   	$categories = Category::orderBy('id', 'desc')->get();
   	return view('BackEnd.pages.categories.index', compact('categories'));
   }

   public function create()
   {
   	$main_categories = Category::orderBy('id', 'desc')->where('parent_id', NULL)->get();
   	return view('BackEnd.pages.categories.create', compact('main_categories'));
   }

   public function store(Request $request)
   {
   	$request->validate([
   		'name' => 'required',
   		'description' => 'required',
   		'image' => 'nullable|image',

   	],
   	[
   		'name.required' => 'Please Provide Category Name',
   		'image.image' => 'Insert a valid image like .jpg, .png extension',
   	]);


   	$category = new Category();

   	$category->name = $request->name;
   	$category->description = $request->description;
   	$category->parent_id = $request->parent_id;


   	if(count($request->image) > 0){
   		$image = $request->file('image');
    	$img = time() . '.' . $image->getClientOriginalExtension();
	    $location = public_path('images/category/' .$img);

	    Image::make($image)->save($location);

	    $category->image = $img;
    	}

   	$category->save();
   	session()->flash('success', 'This category has added successfully.');
   	return redirect()->route('admin.categories');
   }

   public function edit($id)
   {
   	$main_categories = Category::orderBy('id', 'desc')->where('parent_id', NULL)->get();
   	$category = Category::find($id);
   	if (!is_null($category)) {
   		return view('BackEnd.pages.categories.edit', compact('category', 'main_categories'));
   	}else{
   		return redirect()->route('admin.categories');
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
   		'name.required' => 'Please Provide Category Name',
   		'image.image' => 'Insert a valid image like .jpg, .png extension',
   	]);


   	$category = Category::find($id);

   	$category->name = $request->name;
   	$category->description = $request->description;
   	$category->parent_id = $request->parent_id;


   	if(count($request->image) > 0){
   		//Deleted image form folder
   		if (File::exists('images/category/'.$category->image)) {
   			File::delete('images/category/'.$category->image);
   		}
   		$image = $request->file('image');
    	$img = time() . '.' . $image->getClientOriginalExtension();
	    $location = public_path('images/category/' .$img);

	    Image::make($image)->save($location);

	    $category->image = $img;
    	}

   	$category->save();
   	session()->flash('success', 'This category has updated successfully.');
   	return redirect()->route('admin.categories');
   }

   public function delete($id)
    {
    	$category = Category::find($id);
    	if(!is_null($category))
    	{
    		//Delete parent category with sub-categroy
    		if($category->parent_id == NULL){
    			//Delete sub category
    			$sub_categories = Category::orderBy('id', 'desc')->where('parent_id', $category->id)->get();
    			foreach ($sub_categories as $sub) {
    				//Delete sub category image
    				if (File::exists('images/category/'.$sub->image)) {
		   			File::delete('images/category/'.$sub->image);
		   			}
		   			$sub->delete();
    			}
    		}
    		//Delete category image
    		if (File::exists('images/category/'.$category->image)) {
   			File::delete('images/category/'.$category->image);
   			}
    		$category->delete();
    	}
    session()->flash('success', 'This session has been delete successfully!!');
    return back();
    }
}
