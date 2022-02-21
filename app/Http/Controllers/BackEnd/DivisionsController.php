<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Division;
use App\Models\District;

class DivisionsController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
   {
   	$divisions = Division::orderBy('priority')->get();
   	return view('BackEnd.pages.divisions.index', compact('divisions'));
   }

   public function create()
   {
   	return view('BackEnd.pages.divisions.create');
   }

   public function store(Request $request)
   {
   	$request->validate([
   		'name' => 'required',
   		'priority' => 'required',

   	],
   	[
   		'name.required' => 'Please Provide Division Name',
   		'priority.required' => 'Please Provide a division priority',
   	]);


   	$division = new Division();

   	$division->name = $request->name;
   	$division->priority = $request->priority;

   	$division->save();
   	session()->flash('success', 'This division has added successfully.');
   	return redirect()->route('admin.divisions');
   }

   public function edit($id)
   {
   	$division = Division::find($id);
   	if (!is_null($division)) {
   		return view('BackEnd.pages.divisions.edit', compact('division'));
   	}else{
   		return redirect()->route('admin.divisions');
   	}
   }


   public function update(Request $request, $id)
   {
   	$request->validate([
   		'name' => 'required',
   		'priority' => 'required',
   		
   	],
   	[
   		'name.required' => 'Please Provide Division Name',
   		'priority.required' => 'Please Provide a division priority',
   	]);


   	$division = Division::find($id);

   	$division->name = $request->name;
   	$division->priority = $request->priority;

   	$division->save();
   	session()->flash('success', 'This division has updated successfully.');
   	return redirect()->route('admin.divisions');
   }

   public function delete($id)
    {
    	$division = Division::find($id);
    	if(!is_null($division))
    	{
        $district = District::where('division_id', $division->id)->get();
        foreach ($districts as $district) {
          $district =  delete();
        }
    		$division->delete();
   		}
    		
    session()->flash('success', 'This session has been delete successfully!!');
    return back();
    }
}
