<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
class HomeController extends Controller
{

    public function index()
    {
         //$categoryAndProduct =  Category::with('products')->get();
         $categories = Category::orderBy('id', 'DESC')->get();;
         //   return view('/welcome')->with('categories',$categories)->with('categoryAndProduct',$categoryAndProduct);
        return view('/welcome')->with('categories',$categories);

    }

    public function getProducts($cat_id){
      //for filter
      $categories = Category::orderBy('id', 'DESC')->get();
      $products = Product::where('cat_id', $cat_id)->get();
      $search = "";
      return view('/products')->with('categories',$categories)->with('products',$products)->with('search',$search);
    }


    public function searchProduct(Request $request){
      $input = $request->all();
      $search = "<div style = 'border-bottom:1px solid black'><span style = 'font-weight:bold'>".$input['search']."</span><span> search result</span></div>";
      $products = Product::where('product', 'LIKE', '%'.$input["search"].'%')->get();
      //for filter
      $categories = Category::orderBy('id', 'DESC')->get();
      return view('/products')->with('categories',$categories)->with('products',$products)->with('search',$search);
    }
}
