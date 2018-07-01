<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
class HomeController extends Controller
{

    public function index()
    {
        $categoryAndProduct =  Category::with('products')->get();
      //  dd($categoryAndProduct);
          return view('/welcome')->with('categoryAndProduct',$categoryAndProduct);
    }
}
