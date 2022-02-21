<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Slider;

use Image;
use File;



class SlidersController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
   {
   	$sliders = Slider::orderBy('priority', 'asc')->get();
   	return view('BackEnd.pages.sliders.index', compact('sliders'));
   }

   public function store(Request $request)
   {
   	$request->validate([
   		'title' 		=> 'required',
   		'image' 		=> 'required|image',
   		'priority' 		=> 'required',
   		'button_link' 	=> 'nullable|url',

   	],
   	[
   		'title.required' => 'Please Provide Slider title',
   		'image.required' => 'Please Provide slider image',
   		'image.image' => 'Please Provide Valid image like, jpg, png',
   		'priority.required' => 'Please Provide a slider priority',
   		'button_link.url' => 'Please Provide a valid slider button link',
   	]);


   	$slider = new Slider();

   	$slider->title = $request->title;
   	$slider->button_text = $request->button_text;
   	$slider->button_link = $request->button_link;
   	$slider->priority = $request->priority;
  	if($request->image > 0){
   		$image = $request->file('image');
    	$img = time() . '.' . $image->getClientOriginalExtension();
	    $location = public_path('images/sliders/' .$img);

	    Image::make($image)->save($location);

	    $slider->image = $img;
    	}


   	$slider->save();
   	session()->flash('success', 'This slider has added successfully.');
   	return redirect()->route('admin.sliders');
   }

   public function update(Request $request, $id)
   {
   	$request->validate([
   		'title' 		=> 'required',
   		'image' 		=> 'nullable|image',
   		'priority' 		=> 'required',
   		'button_link' 	=> 'nullable|url',

   		
   	],
   	[
   		'title.required' => 'Please Provide Slider title',
   		'image.image' => 'Please Provide Valid image like, jpg, png',
   		'priority.required' => 'Please Provide a slider priority',
   		'button_link.url' => 'Please Provide a valid slider button link',
   	]);


   	$division = Slider::find($id);

   	$slider->title = $request->title;
   	$slider->button_text = $request->button_text;
   	$slider->button_link = $request->button_link;
   	$slider->priority = $request->priority;
  	if(count($request->image) > 0){
   		//Deleted image form folder
   		if (File::exists('images/sliders/'.$slider->image)) {
   			File::delete('images/sliders/'.$slider->image);
   		}
   		$image = $request->file('image');
    	$img = time() . '.' . $image->getClientOriginalExtension();
	    $location = public_path('images/sliders/' .$img);

	    Image::make($image)->save($location);

	    $slider->image = $img;
    	}
   	$division->save();
   	session()->flash('success', 'This Slider has updated successfully.');
   	return redirect()->route('admin.sliders');
   }

   public function delete($id)
    {
    	$slider = Slider::find($id);
    	if(!is_null($slider))
    	{
    		//Delete slider image
    		if (File::exists('images/sliders/'.$slider->image)) {
   			File::delete('images/sliders/'.$slider->image);
   			}
    		$slider->delete();
    	}
    		
    session()->flash('success', 'This session has been delete successfully!!');
    return back();
    }
}
