<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('home');
    }

    public function mainPage()
    {
        if (Auth::user()) {
            Session::put('user', auth()->user()->name);
        }
        // $result = DB::table("categories")->where('id', '>','0')->get();//query builder
        $result = Category::all();
        return view('welcome', ['categories' => $result]);
    }
}
