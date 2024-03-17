<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $slider = Slider::orderBy('id','desc')->get();            //for pagination
        $products = Product::orderBy('id','desc')->paginate(9);  //paginate(1)
       return view('pages.home.index',compact('slider','products'));
    }
}
