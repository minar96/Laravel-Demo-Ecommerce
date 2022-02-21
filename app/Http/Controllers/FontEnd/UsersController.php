<?php

namespace App\Http\Controllers\FontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Auth;

use App\Models\Division;
use App\Models\District;

class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
    	$user = Auth::User();
    	return view('FontEnd.pages.users.dashboard', compact('user'));
    }

    public function profile()
    {
    	$divisions = Division::orderBy('priority', 'asc')->get();
        $districts = District::orderBy('name', 'asc')->get();
    	$user = Auth::User();
    	return view('FontEnd.pages.users.profile', compact('user', 'divisions', 'districts'));
    }

    public function profileUpdate(Request $request)
    {
    	$user = Auth::User();

    	$this->validate($request,[
    		'first_name'    => ['required', 'string', 'max:30'],
            'last_name'     => ['nullable', 'string', 'max:30'],
            'user_name' => ['required', 'alpha_dash', 'unique:users,user_name,'.$user->id],
            'phone_no'      => ['required', 'max:15'],
        'email'     => ['required', 'string', 'email', 'max:100', 'unique:users,email,'.$user->id],
             //'password'     => ['required', 'string', 'min:8', 'confirmed'],
            'street_address' => ['required', 'max:100'],
            'division_id'   => ['required', 'numeric'],
            'district_id'   => ['required', 'numeric'],
    	]);

    	

    		$user->first_name    = $request->first_name;
            $user->last_name     = $request->last_name;
            $user->user_name     = $request->user_name;
            $user->phone_no		= $request->phone_no;
            $user->email         = $request->email;
            //'password'      => Hash::make($request->password),
            $user->street_address 		= $request->street_address;
            $user->shipping_address 	= $request->shipping_address;
            if ($request->password != NULL || $request->password !="") {
            	$user->password = Hash::make($request->password);
            }
            $user->division_id		= $request->division_id;
            $user->district_id  = $request->district_id;
            $user->ip_address    = request()->ip();

            $user->save();

            session()->flash('success', 'Update your profile successfully!!');

    	return back();
    }
}
