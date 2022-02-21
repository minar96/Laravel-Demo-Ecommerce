<?php

namespace App\Http\Controllers\FontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\User;

class VerificationController extends Controller
{
    public function verify($token)
    {
    	$user =  User::where('remember_token', $token)->first();
    	if (!is_null($user)) {
    		$user->status = 1;
    		$user->remember_token = NULL;
    		$user->save();
	    	session()->flash('success', 'Your are registered successfully !!! Now Login');
	    	return redirect('login');
    	}else{
    		session()->flash('errors', 'Your token are not matched');
    		return redirect('/');
    	}

    }
}
