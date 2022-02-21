<?php
namespace App\Http\Controllers\BackEnd;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
