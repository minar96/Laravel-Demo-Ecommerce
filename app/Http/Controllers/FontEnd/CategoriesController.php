<?php

namespace App\Http\Controllers\FontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Category;

class CategoriesController extends Controller
{
    
    public function index()
    {
        //
    }

   
    public function show($id)
    {
        $category = Category::find($id);
        if (!is_null($category)) {
            return view('FontEnd.pages.categories.show', compact('category'));
        }else{
            session()->flash('errors', 'SorrY!! There is no category in this URL');
            return redirect('/');
        }
    }

    
}
