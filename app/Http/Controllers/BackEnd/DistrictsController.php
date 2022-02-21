<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\District;
use App\Models\Division;


class DistrictsController extends Controller
{
  public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
   {
   	$districts = District::orderBy('name', 'asc')->get();
   	return view('BackEnd.pages.districts.index', compact('districts'));
   }

   public function create()
   {
   	$divisions = Division::orderBy('priority', 'asc')->get();
   	return view('BackEnd.pages.districts.create', compact('divisions'));
   }

   public function store(Request $request)
   {
   	$request->validate([
   		'name' => 'required',
   		'division_id' => 'required',

   	],
   	[
   		'name.required' => 'Please Provide District Name',
   		'division_id.required' => 'Please Provide a division for district',
   	]);


   	$district = new District();

   	$district->name = $request->name;
   	$district->division_id = $request->division_id;

   	$district->save();
   	session()->flash('success', 'This district has added successfully.');
   	return redirect()->route('admin.districts');
   }

   public function edit($id)
   {
   	$divisions = Division::orderBy('priority', 'asc')->get();
   	$district = District::find($id);
   	if (!is_null($district)) {
   		return view('BackEnd.pages.districts.edit', compact('district', 'divisions'));
   	}else{
   		return redirect()->route('admin.districts');
   	}
   }


   public function update(Request $request, $id)
   {
   	$request->validate([
   		'name' => 'required',
   		'division_id' => 'required',
   		
   	],
   	[
   		'name.required' => 'Please Provide District Name',
   		'division_id.required' => 'Please Provide a division for district',
   	]);


   	$district = District::find($id);

   	$district->name = $request->name;
   	$district->division_id = $request->division_id;

   	$district->save();
   	session()->flash('success', 'This district has updated successfully.');
   	return redirect()->route('admin.districts');
   }

   public function delete($id)
    {
    	$district = District::find($id);
    	if(!is_null($district))
    	{
    		$district->delete();
   		}
    		
    session()->flash('success', 'This session has been delete successfully!!');
    return back();
    }
}
